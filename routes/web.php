<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/coming-soon', function () {
    return view('maintenance');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy');
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('terms');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::match(['get', 'post'], '/search-id', [HomeController::class, 'idSearch'])->name('search.id');
    Route::match(['get', 'post'], '/search-advanced', [HomeController::class, 'advancedSearch'])->name('search.advanced');
    Route::get('/profile/{id}', [HomeController::class, 'profileView'])->name('profile.view');
    
    Route::middleware('auth')->group(function () {
    Route::get('/register-details', [ProfileController::class, 'createDetails'])->name('register.details');
    Route::post('/register-details', [ProfileController::class, 'storeDetails'])->name('register.details.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // AJAX Routes
    Route::get('/api/states/{country_id}', [ProfileController::class, 'getStates']);
    Route::get('/api/cities/{state_id}', [ProfileController::class, 'getCities']);
    Route::get('/api/subcastes/{caste_id}', [ProfileController::class, 'getSubcastes']);
    Route::get('/api/gotharams/{caste_id}', [ProfileController::class, 'getGotharams']);
    Route::get('/api/stars/{raasi_id}', [ProfileController::class, 'getStars']);
});


Route::get('/adminpanel', function () {
    return redirect('/admin/dashboard');
});
Route::get('/adminPanel', function () {
    return redirect('/admin/dashboard');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Members Management
        Route::prefix('members')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\MemberManagementController::class, 'allMembers'])->name('admin.members.all');
            Route::get('/premium', [App\Http\Controllers\Admin\MemberManagementController::class, 'premiumMembers'])->name('admin.members.premium');
            Route::get('/free', [App\Http\Controllers\Admin\MemberManagementController::class, 'freeMembers'])->name('admin.members.free');
            Route::get('/deleted', [App\Http\Controllers\Admin\MemberManagementController::class, 'deletedMembers'])->name('admin.members.deleted');
            Route::get('/pending', [App\Http\Controllers\Admin\MemberManagementController::class, 'pendingMembers'])->name('admin.members.pending');
            Route::get('/view/{id}', [App\Http\Controllers\Admin\MemberManagementController::class, 'viewMember'])->name('admin.members.view');
            Route::post('/approve/{id}', [App\Http\Controllers\Admin\MemberManagementController::class, 'approveMember'])->name('admin.members.approve');
            Route::post('/suspend/{id}', [App\Http\Controllers\Admin\MemberManagementController::class, 'suspendMember'])->name('admin.members.suspend');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\MemberManagementController::class, 'deleteMember'])->name('admin.members.delete');
            Route::get('/create', [App\Http\Controllers\Admin\MemberManagementController::class, 'createMember'])->name('admin.members.create');
            Route::post('/store', [App\Http\Controllers\Admin\MemberManagementController::class, 'storeMember'])->name('admin.members.store');
            
            // Photo & Horoscope Queues
            Route::get('/photo-queue', [App\Http\Controllers\Admin\MemberManagementController::class, 'photoQueue'])->name('admin.members.photo_queue');
            Route::post('/photo-update/{id}', [App\Http\Controllers\Admin\MemberManagementController::class, 'updatePhotoStatus'])->name('admin.members.photo_update');
            Route::get('/horoscope-queue', [App\Http\Controllers\Admin\MemberManagementController::class, 'horoscopeQueue'])->name('admin.members.horoscope_queue');
            Route::post('/horoscope-update/{id}', [App\Http\Controllers\Admin\MemberManagementController::class, 'updateHoroscopeStatus'])->name('admin.members.horoscope_update');
        });

        // Search
        Route::match(['get', 'post'], '/search/basic', [App\Http\Controllers\Admin\AdminController::class, 'basicSearch'])->name('admin.search.basic');

        // Payments & Plans
        Route::get('/payment-list', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.payment_list');
        Route::get('/plans', [App\Http\Controllers\Admin\PaymentController::class, 'plans'])->name('admin.plans');
        Route::post('/plans/store', [App\Http\Controllers\Admin\PaymentController::class, 'storePlan'])->name('admin.plans.store');
        Route::post('/plans/update/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'updatePlan'])->name('admin.plans.update');
        Route::post('/plans/assign', [App\Http\Controllers\Admin\PaymentController::class, 'assignPlan'])->name('admin.members.assign_plan');

        // Other Sections
        Route::get('/expired-list', [App\Http\Controllers\Admin\MemberManagementController::class, 'expiredList'])->name('admin.expired_list');
        Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [App\Http\Controllers\Admin\AdminController::class, 'updateSettings'])->name('admin.settings.update');

        Route::get('/change-password', [App\Http\Controllers\Admin\AdminAuthController::class, 'showChangePassword'])->name('admin.change_password');
        Route::post('/change-password', [App\Http\Controllers\Admin\AdminAuthController::class, 'updatePassword'])->name('admin.change_password.submit');

        // Master Data CRUD
        Route::prefix('master')->group(function () {
            Route::get('/{type}', [App\Http\Controllers\Admin\MasterDataController::class, 'index'])->name('admin.master.index');
            Route::post('/{type}', [App\Http\Controllers\Admin\MasterDataController::class, 'store'])->name('admin.master.store');
            Route::post('/{type}/update/{id}', [App\Http\Controllers\Admin\MasterDataController::class, 'update'])->name('admin.master.update');
            Route::delete('/{type}/delete/{id}', [App\Http\Controllers\Admin\MasterDataController::class, 'destroy'])->name('admin.master.delete');
        });
    });
});


// Storage Workaround for shared hosting (disabled symlink)
Route::get('storage/{path}', function ($path) {
    $path = storage_path('app/public/' . $path);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file)->header('Content-Type', $type);
})->where('path', '.*');

require __DIR__.'/auth.php';
