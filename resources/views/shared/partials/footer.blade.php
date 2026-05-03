<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                {{ \App\Models\Setting::get('footer_text', '© ' . date('Y') . ' Sri Vaarahi Matrimony. All rights reserved.') }}
            </div>
            <div class="col-md-6 text-md-end d-none d-md-block">
                Design & Developed by <span class="fw-bold text-primary">Vaarahi Team</span>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
