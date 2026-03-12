<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    private static $_expirySettings = null;

    protected $table = 'free_user';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'emailid',
        'password',
        'mobileno',
        'gender',
        'userid',
        'onbehalf',
        'status',
        'date',
        'dob',
        'birth_time',
        'birth_city',
        'maritalstatus',
        'language',
        'education',
        'employment',
        'occupation',
        'indian_currency_value',
        'height',
        'weight',
        'father_name',
        'mother_name',
        'father_occupation',
        'mother_occupation',
        'no_of_siblings',
        'no_of_siblings_married',
        'caste',
        'subcaste',
        'raasi',
        'star',
        'gold_details',
        'address',
        'assets',
        // Adding horoscope grid fields to fillable if they are direct columns in the 'free_user' table.
        // If these fields belong to a separate 'member_horoscopes' table, they should not be here.
        // Assuming for this edit that they are intended for the User model's table.
        'raasi_1', 'raasi_2', 'raasi_3', 'raasi_4', 'raasi_5', 'raasi_6',
        'raasi_7', 'raasi_8', 'raasi_9', 'raasi_10', 'raasi_11', 'raasi_12',
        'amsam_1', 'amsam_2', 'amsam_3', 'amsam_4', 'amsam_5', 'amsam_6',
        'amsam_7', 'amsam_8', 'amsam_9', 'amsam_10', 'amsam_11', 'amsam_12',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // CI project uses plain text or different hashing
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public static function generateUserId()
    {
        $lastUser = static::orderBy('id', 'desc')->first();
        if (!$lastUser || !$lastUser->userid) {
            return 'SSM1001';
        }

        $new_bond_prefix = 'SSM';
        $quotationnoss = $lastUser->userid;
        $quotationnos = str_replace($new_bond_prefix, '', $quotationnoss);
        
        $bondLen = strlen($quotationnos);
        $bondOnlyNum = (int) preg_replace('/[^0-9]/', '', $quotationnos);
        
        return $new_bond_prefix . sprintf('%0' . max(4, $bondLen) . 'd', $bondOnlyNum + 1);
    }

    public function getEmailAttribute()
    {
        return $this->emailid;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['emailid'] = $value;
    }

    public function profileImages()
    {
        return $this->hasMany(ProfileImage::class, 'userid', 'id');
    }

    public function latestProfileImage()
    {
        return $this->hasOne(ProfileImage::class, 'userid', 'id')->where('status', 1)->latest();
    }

    /**
     * Check if the user profile is expired based on global settings.
     */
    public function isExpired()
    {
        // Don't expire active premium members unless you want to
        // For now, let's follow the logic that it might apply to the registration date
        
        if (self::$_expirySettings === null) {
            self::$_expirySettings = \Illuminate\Support\Facades\DB::table('profile_ex_status')->first();
        }

        if (!self::$_expirySettings || !self::$_expirySettings->expire_status || !self::$_expirySettings->count) {
            return false;
        }

        if (!$this->date) {
            return false;
        }

        try {
            $registrationDate = \Carbon\Carbon::parse($this->date);
            $expiryDate = clone $registrationDate;

            switch (self::$_expirySettings->expire_status) {
                case 'date':
                    $expiryDate->addDays(self::$_expirySettings->count);
                    break;
                case 'month':
                    $expiryDate->addMonths(self::$_expirySettings->count);
                    break;
                case 'year':
                    $expiryDate->addYears(self::$_expirySettings->count);
                    break;
                default:
                    return false;
            }

            return \Carbon\Carbon::now()->greaterThan($expiryDate);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Virtual attribute for expiry status
     */
    public function getIsExpiredAttribute()
    {
        return $this->isExpired();
    }
}
