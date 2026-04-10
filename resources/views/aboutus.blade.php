@extends('layouts.frontend')

<style>
    .about-txt h3 {
        font-size: 28px;
        color: #810463;
        font-weight: 700;
    }

    .about-txt h4 {
        font-size: 22px;
        color: #7b0461;
        margin-top: 24px;
        font-weight: 600;
    }

    .nav-tabs {
        border-bottom: 2px solid #810463;
        margin-bottom: 30px;
    }

    .nav-tabs .nav-link {
        color: #810463;
        font-weight: 600;
        font-size: 18px;
        border: none;
        padding: 10px 25px;
    }

    .nav-tabs .nav-link.active {
        background-color: #810463;
        color: #fff !important;
        border-radius: 5px 5px 0 0;
    }

    .tab-content {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .about-txt ul li {
        list-style: none;
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .about-txt ul li:before {
        content: "✔";
        position: absolute;
        left: 0;
        color: #810463;
        font-weight: bold;
    }
</style>


@section('content')
    <section class="about-txt"
        style="background-image: url({{ asset('assets/images/logo/premium-services-bg.jpg') }}); padding-bottom: 80px; padding-top: 50px; background-attachment: fixed;">
        <div class="container">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="aboutTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english" role="tab"
                        aria-controls="english" aria-selected="true">English</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tamil-tab" data-toggle="tab" href="#tamil" role="tab" aria-controls="tamil"
                        aria-selected="false">தமிழ்</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="aboutTabsContent">
                <!-- English Tab -->
                <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
                    <h3 class="mb-4">🌸 About Us – Sri Vaarahi Matrimony</h3>
                    <p>
                        Sri Vaarahi Matrimony is a divine marriage guidance platform functioning under the blessings of Sri
                        Laghu Vaarahi Amman and the Rahu–Ketu Parihara Temple, offering horoscope-based matchmaking
                        services.
                    </p>
                    <p>
                        In today’s world, marriage is not just a union of two individuals; it is a sacred bond that connects
                        families, values, and lifelong commitments. Understanding this, we approach every alliance with care
                        through astrology, parihara guidance, and family-oriented coordination.
                    </p>
                    <p>
                        With the divine grace of Sri Vaarahi Amman, we sincerely strive to help every registered profile
                        find the most suitable and compatible life partner with complete honesty and dedication.
                    </p>
                    <p>
                        This is a matrimony service built purely on a service-oriented approach. Apart from the registration
                        fee, we do not charge any broker commission.
                    </p>

                    <h4 class="mt-4 mb-3">✨ Our Services</h4>
                    <ul>
                        <li>Horoscope matching and detailed analysis</li>
                        <li>Rahu–Ketu dosha guidance and remedies for marriage delays</li>
                        <li>Verified and genuine profiles</li>
                        <li>Family-oriented alliance support</li>
                        <li>Personal consultation and guided matchmaking</li>
                    </ul>

                    <h4 class="mt-4 mb-3">💠 Our Special Services</h4>
                    <ul>
                        <li>As an introductory offer, free profile registration for both bride and groom</li>
                        <li>Free registration for women from economically weaker families (education up to +2)</li>
                        <li>Free registration for women seeking remarriage</li>
                    </ul>

                    <p class="mt-3">
                        We believe that marriage is not just a match, but a divinely guided and destined union. Our services
                        are available across Tamil Nadu, Singapore, Malaysia, Sri Lanka, and Canada.
                    </p>

                    <hr style="border-top: 2px solid #810463; width: 100%; margin: 40px 0;">

                    <h3 class="mb-4">🌺 Sri Nava Vaarahi Amman Arutpani Trust</h3>
                    <p>
                        Under our Sri Nava Vaarahi Amman Arutpani Trust, we plan to establish a total of 10 Vaarahi temples.
                        Of these, nine will be dedicated to manifestations of Vaarahi representing the Navagrahas, and one
                        will be a unique individual Vaarahi temple. Currently, the Laghu Vaarahi and Rahu-Ketu temples have
                        been successfully completed.
                    </p>

                    <h4 class="mt-4 mb-3">🛕 Upcoming Temple</h4>
                    <p>
                        Soon, the Sri Mahisharuda Mrityunjaya Vaarahi Temple will be established in Tiruvallarai. This
                        manifestation of the Goddess embodies the powers of Lord Shani (Saturn) and Lord Yama Dharma. Other
                        Vaarahi temples will be constructed sequentially for the welfare of devotees.
                    </p>

                    <h4 class="mt-4 mb-3">🔮 Specialities of Laghu Vaarahi Temple</h4>
                    <p>
                        At the Laghu Vaarahi Temple, on the auspicious Panchami Tithi, devotees can personally perform
                        Parihara Pooja and Homas for Rahu-Ketu Dosha. Through these rituals, obstacles are removed, and one
                        receives divine blessings for success in all endeavours. Additionally, performing Annadanam
                        (offering food) helps clear life’s hurdles.
                    </p>

                    <h4 class="mt-4 mb-3">🔱 Specialities of Mahisharuda Mrityunjaya Vaarahi Temple</h4>
                    <p>
                        Those facing challenges due to Shani Dosha, serious ailments, severe obstacles, or enemies will find
                        relief by contributing to and participating in the construction of this temple. Their sins are
                        cleansed, leading to a prosperous life.
                    </p>

                    <p class="mt-4 font-weight-bold" style="color: #810463;">
                        By the grace of Sri Vaarahi Amman, may sorrows vanish and lives be filled with prosperity and
                        success.
                    </p>
                </div>

                <!-- Tamil Tab -->
                <div class="tab-pane fade" id="tamil" role="tabpanel" aria-labelledby="tamil-tab">
                    <h3 class="mb-4">🌺 எங்களைப் பற்றி – ஸ்ரீ வாராஹி திருமண மையம்</h3>
                    <p>
                        ஸ்ரீ வாராஹி திருமண மையம் என்பது, ஸ்ரீ லகு வாராஹி அம்மன் திருவருளும் மற்றும் ராகு–கேது பரிகார
                        திருக்கோவில் ஆசீர்வாதமும் உடன் செயல்படும், ஜாதக அடிப்படையிலான திருமண வழிகாட்டும் மையமாகும்.
                    </p>
                    <p>
                        இன்றைய காலத்தில் திருமணம் என்பது ஒரு சாதாரண இணைவு அல்ல; அது குடும்பம், மதிப்புகள் மற்றும் வாழ்க்கை
                        முழுவதையும் இணைக்கும் ஒரு புனித பந்தமாகும். இதை உணர்ந்து, நாங்கள் ஒவ்வொரு திருமண இணைப்பையும்
                        ஜோதிடம், பரிகாரம் மற்றும் குடும்ப ஒத்துழைப்பு மூலம் கவனமாக அணுகுகிறோம்.
                    </p>
                    <p>
                        ஸ்ரீ வாராஹி அம்மனின் திருவருளால், இங்கு பதிவு செய்யப்படும் அனைத்து ஜாதகங்களுக்கும் மிகச் சிறந்ததும்,
                        முழுமையான பொருத்தமுடையதும் ஆன வரன்களைத் தேர்வு செய்ய
                        எங்களால் முடிந்தவரை உதவுகிறோம்.
                    </p>
                    <p>
                        இது ஒரு முழுக்க முழுக்க சேவை மனப்பான்மையுடன் செயல்படும் ஸ்ரீ வாராஹி மேட்ரிமோனி. பதிவு கட்டணங்களைத் தவிர,
                        எந்த விதமான புரோக்கர் கமிஷனும் நாங்கள் வசூலிப்பதில்லை.
                    </p>

                    <h4 class="mt-4 mb-3">✨ எங்களின் சேவைகள்</h4>
                    <ul>
                        <li>ஜாதக பொருத்தம் மற்றும் விரிவான ஆய்வு</li>
                        <li>ராகு–கேது தோஷம் மற்றும் திருமண தாமதத்திற்கு பரிகார வழிகாட்டுதல்</li>
                        <li>நம்பகமான மற்றும் சரிபார்க்கப்பட்ட சுயவிவரங்கள்</li>
                        <li>குடும்ப அடிப்படையிலான திருமண இணைப்பு</li>
                        <li>நேரடி ஆலோசனை மற்றும் தனிப்பட்ட வழிகாட்டுதல்</li>
                    </ul>

                    <h4 class="mt-4 mb-3">💠 எங்களின் சிறப்பு சேவைகள்</h4>
                    <ul>
                        <li>அறிமுக சலுகையாக, மணமகன் மற்றும் மணமகள் இருவருக்கும் ஜாதக பதிவு முற்றிலும் இலவசம்.</li>
                        <li>வசதி குறைவான குடும்பங்களில் பிறந்த பெண்கள் (படிப்பு: +2 வரை) – இலவச பதிவு.</li>
                        <li>மறுமணம் பெண்களின் ஜாதக பதிவு – கட்டணமின்றி வழங்கப்படுகிறது.</li>
                    </ul>

                    <p class="mt-3">
                        நாங்கள், திருமண இணைப்பை வெறும் பொருத்தமாக அல்லாமல், தெய்வ அருளால் அமைக்கப்படும் பாக்கியமான நிகழ்வாக
                        கருதுகிறோம். தமிழ்நாடு மட்டுமின்றி, சிங்கப்பூர், மலேசியா, இலங்கை மற்றும் கனடா ஆகிய நாடுகளில் உள்ள
                        தமிழர்களுக்கும் எங்கள் சேவைகள் வழங்கப்படுகின்றன.
                    </p>

                    <hr style="border-top: 2px solid #810463; width: 100%; margin: 40px 0;">

                    <h3 class="mb-4">🌺 ஸ்ரீ நவவாராஹி அம்மன் அருட்பணி அறக்கட்டளை</h3>
                    <p>
                        எங்களது ஸ்ரீ நவவாராஹி அம்மன் அருட்பணி அறக்கட்டளை மூலம், மொத்தம் 10 வாராஹி ஆலயங்களை நிறுவ
                        திட்டமிடப்பட்டுள்ளது. அவற்றில், ஒன்பது ஆலயங்கள் நவகிரகங்களின் அம்சங்களைக் கொண்ட வாராஹி
                        ஆலயங்களாகவும், ஒன்று தனிப்பட்ட வாராஹி ஆலயமாகவும் அமைக்கப்படும். இதன் ஒரு பகுதியாக, லகு வாராஹி ஆலயம்
                        மற்றும் ராகு–கேது ஆலயங்கள் வெற்றிகரமாக கட்டி முடிக்கப்பட்டுள்ளன.
                    </p>

                    <h4 class="mt-4 mb-3">🛕 வரவிருக்கும் ஆலயம்</h4>
                    <p>
                        விரைவில், திருவள்ளரையில் ஸ்ரீ மஹிஷாரூட ம்ருத்யுஞ்ஜெய வாராஹி ஆலயம் அமைக்கப்பட உள்ளது. இந்த அம்மன்,
                        சனி பகவான் மற்றும் எமதர்மன் அம்சங்களைக் கொண்ட தெய்வீக சக்தியாக விளγράφிறார். இதேபோல், மற்ற வாராஹி
                        ஆலயங்களும் ஒன்றன் பின் ஒன்றாக பக்தர்களின் நலனுக்காக கட்டப்படவுள்ளன.
                    </p>

                    <h4 class="mt-4 mb-3">🔮 லகு வாராஹி ஆலயத்தின் சிறப்பு</h4>
                    <p>
                        லகு வாராஹி ஆலயத்தில், பஞ்சமி திதியில் ராகு–கேது தோஷம் உள்ளவர்கள் தாங்களே தங்களது கைகளால்
                        ராகு–கேதுவிற்கு பரிகார பூஜை செய்வதன் மூலமும், பரிகார ஹோமங்கள் நடத்துவதன் மூலமும், அந்த தோஷங்கள்
                        நீங்கி பரிபூரண அருளைப் பெற்று நினைத்த காரியங்களில் வெற்றி பெறுவார்கள். மேலும், தங்களது கைகளால்
                        அன்னதானம் வழங்குவதன் மூலம், வாழ்க்கையில் உள்ள தடைகள் நீங்கி நல்வாழ்வு வாழ்வார்கள்.
                    </p>

                    <h4 class="mt-4 mb-3">🔱 மஹிஷாரூட ம்ருத்யுஞ்ஜெய வாராஹி ஆலயத்தின் சிறப்பு</h4>
                    <p>
                        சனி பகவானால் பாதிக்கப்பட்டவர்கள், பெரிய நோய்கள், கடுமையான தடைகள் அல்லது எதிரிகள் போன்ற சிக்கல்களை
                        எதிர்கொள்பவர்கள், ஸ்ரீ மஹிஷாரூட ம்ருத்யுஞ்ஜெய வாராஹி ஆலயம் கட்டுவதிலும், கட்டுமான பணியில் ஈடுபடுவதன்
                        மூலமும் அவர்களின் பாவங்கள் நீக்கப்பட்டு பெருவாழ்வு வாழ்வார்கள்.
                    </p>

                    <p class="mt-4 font-weight-bold" style="color: #810463;">
                        இவ்வாறு, ஸ்ரீ வாராஹி அம்மன் அருளால், பக்தர்களின் வாழ்க்கையில் உள்ள துன்பங்கள் நீங்கி, வளமும், வெற்றியும்
                        நிரம்பிய வாழ்வு அமையும்.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

</div>
</div>
</div>
</section>

</div>
</div>
</section>