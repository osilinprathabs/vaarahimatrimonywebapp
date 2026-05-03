@extends('layouts.frontend')

@section('styles')
    <style>
        .about-txt h3 {
            font-size: 28px;
            color: #000;
        }

        .about-txt h4 {
            font-size: 25px;
            color: #7b0461;
            margin-top: 24px;
        }
    </style>
@endsection

@section('content')
    <section class="about-txt"
        style="background-image: url({{ asset('assets/images/logo/premium-services-bg.jpg') }}); padding-bottom: 50px; padding-top: 50px;">
        <div class="container">
            <h3>Terms and conditions of use Introduction</h3>
            <p>1. These terms and conditions shall govern your use of our website srivaarahimatrimony.com and Sri Vaarahi
                Matrimony App in Google play store.</p>
            <p>1.1. By using our website and Sri Vaarahi Matrimony App, you accept these terms and conditions in full;
                accordingly, if you disagree with these terms and conditions or any part of these terms and conditions, you
                must not use our website and Sri Vaarahi Matrimony App.</p>
            <p>1.2. If you register with our website or Sri Vaarahi Matrimony App, submit any material to our website or Sri
                Vaarahi Matrimony App or use any of our website services, we will ask you to expressly agree to these terms
                and conditions.</p>
            <p>1.3. You must be at least [18] years of age up to use our website and Sri Vaarahi Matrimony App.</p>

            <h3>2. Licence to use website and Sri Vaarahi Matrimony App</h3>
            <p>2.1. You may view pages, stream audio/video, and use the website for personal use.</p>

            <h3>3. Acceptable use</h3>
            <p>3.1. You must not use the website in any way that causes damage or impairment to the website performance.</p>

            <h3>4. Registration and accounts</h3>
            <p>4.1. You may register for an account by completing the form on our website.</p>

            <h3>5. User login details</h3>
            <p>5.1. You will be asked to choose a user ID and password.</p>

            <h3>6. Cancellation and suspension of account</h3>
            <p>6.1. We reserve the right to suspend or cancel your account at any time.</p>

            <h3>7. Your content: licence</h3>
            <p>7.1. You grant us a worldwide licence to use, store, and publish your content.</p>

            <h3>Payments Information</h3>
            <p><b>Non Returnable</b></p>
        </div>
    </section>
@endsection