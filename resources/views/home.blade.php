@extends('layouts.frontend')

@section('content')
  <style>
    .section-title {
      position: relative;
      margin-bottom: 10px;
    }
  </style>

  <!--START REVOLUTION SLIDER 6.0.1-->
  <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery">
    <rs-module id="rev_slider_1_1" data-version="6.1.2" class="rev_slider_1_1_height">

      <rs-slides>

        <rs-slide data-key="rs-2" data-title="Slide" data-thumb="{{ asset('assets/images/slides/banner2.png') }}"
          data-anim="ei:d;eo:d;s:d;r:0;t:boxrandomrotate;sl:d;">

          <img src="{{ asset('assets/images/slides/banner2.png') }}" title="slider-main-img03" width="1263" height="500"
            class="rev-slidebg" data-no-retina>

          <!--   <rs-layer
            id="slider-1-slide-2-layer-0" 
            data-type="text"
            data-rsp_ch="on"
            data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:m;yo:-88px,-88px,-114px,-100px;"
            data-text="w:normal;s:70,70,70,53;l:130,130,100,80;fw:700;a:center;"
            data-frame_0="x:50,50,31,19;"
            data-frame_1="st:100;sp:800;sR:100;"
            data-frame_999="o:0;st:w;sR:8100;"
            style="z-index:8;font-family:Cormorant;"
            >Professional  
          </rs-layer>

          <rs-layer
          id="slider-1-slide-2-layer-1" 
          data-type="text"
          data-color="#e5e5e5"
          data-rsp_ch="on"
          data-xy="x:l,l,c,c;xo:50px,50px,801px,594px;y:m;yo:86px,86px,-110px,-75px;"
          data-text="w:normal;s:17,17,16,13;l:28,28,25,20;a:left,left,center,center;"
          data-vbility="t,t,f,f"
          data-frame_0="y:50,50,31,19;"
          data-frame_1="st:520;sp:500;sR:520;"
          data-frame_999="o:0;st:w;sR:7980;"
          style="z-index:11;font-family:Hind;"
          >The argument in favor of using filler text this your goes something like this <br> review point you’ll end up reviewing lorem and negotiating.  
          </rs-layer>

          <a
          id="slider-1-slide-2-layer-4" 
          class="rs-layer"
          href="services-1.html" target="_self" rel="nofollow"
          data-type="text"
          data-rsp_ch="on"
          data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:m;yo:184px,184px,54px,40px;"
          data-text="w:normal;s:19,19,17,17;l:28,28,20,18;fw:700;a:center;"
          data-padding="t:12;r:45,45,35,30;b:12;l:45,45,35,30;"
          data-border="bos:solid;boc:#ffffff;bow:1px,1px,1px,1px;bor:3px,3px,3px,3px;"
          data-frame_0="y:50,50,31,19;"
          data-frame_1="st:650;sp:500;sR:650;"
          data-frame_999="o:0;st:w;sR:7850;"
          data-frame_hover="c:#121f38;bgc:#fff;boc:#fff;bor:3px,3px,3px,3px;bos:solid;bow:1px,1px,1px,1px;"
          style="z-index:12;font-family:Cormorant;"
          >More Services! 
        </a>

        <rs-layer
        id="slider-1-slide-2-layer-11" 
        data-type="text"
        data-rsp_ch="on"
        data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:m;yo:-8px,-8px,-36px,-39px;"
        data-text="w:normal;s:70,70,70,53;l:130,130,100,80;fw:700;a:center;"
        data-frame_0="x:50,50,31,19;"
        data-frame_1="st:240;sp:800;sR:240;"
        data-frame_999="o:0;st:w;sR:7960;"
        style="z-index:9;font-family:Cormorant;"
        >Wedco Photography 
        </rs-layer>

        <a
        id="slider-1-slide-2-layer-12" 
        class="rs-layer"
        href="contact-us.html" target="_self" rel="nofollow"
        data-type="text"
        data-rsp_ch="on"
        data-xy="x:l,l,c,c;xo:283px,283px,0,0;y:m;yo:184px,184px,120px,98px;"
        data-text="w:normal;s:19,19,17,17;l:28,28,20,18;fw:700;a:center;"
        data-padding="t:12;r:45,45,35,30;b:12;l:45,45,35,30;"
        data-border="bos:solid;boc:#c78665;bow:1px,1px,1px,1px;bor:3px,3px,3px,3px;"
        data-frame_0="y:50,50,31,19;"
        data-frame_1="st:730;sp:500;sR:730;"
        data-frame_999="o:0;st:w;sR:7770;"
        data-frame_hover="bgc:#ba7552;boc:#ba7552;bor:3px,3px,3px,3px;bos:solid;bow:1px,1px,1px,1px;"
        style="z-index:13;background-color:#c78665;font-family:Cormorant;"
        >Conatct Us! 
      </a>
      -->
        </rs-slide>

        <rs-slide data-key="rs-5" data-title="Slide" data-thumb="{{ asset('assets/images/slides/banner1.png') }}"
          data-anim="ei:d;eo:d;s:d;r:0;t:boxrandomrotate;sl:d;">

          <img src="{{ asset('assets/images/slides/banner1.png') }}" title="slider-main-img04" width="1263" height="500"
            class="rev-slidebg" data-no-retina>

          <!--  <rs-layer
      id="slider-1-slide-5-layer-0" 
      data-type="text"
      data-rsp_ch="on"
      data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:m;yo:-85px,-85px,-114px,-94px;"
      data-text="w:normal;s:70,70,70,45;l:130,130,100,66;fw:700;a:center;"
      data-frame_0="x:50,50,31,19;"
      data-frame_1="st:100;sp:800;sR:100;"
      data-frame_999="o:0;st:w;sR:8100;"
      style="z-index:8;font-family:Cormorant;"
      >We are Basics of 
      </rs-layer>

      <rs-layer
      id="slider-1-slide-5-layer-1" 
      data-type="text"
      data-color="#e5e5e5"
      data-rsp_ch="on"
      data-xy="x:l,l,c,c;xo:50px,50px,801px,594px;y:m;yo:87px,87px,-110px,-75px;"
      data-text="w:normal;s:17,17,16,13;l:28,28,25,20;a:left,left,center,center;"
      data-vbility="t,t,f,f"
      data-frame_0="y:50,50,31,19;"
      data-frame_1="st:520;sp:500;sR:520;"
      data-frame_999="o:0;st:w;sR:7980;"
      style="z-index:11;font-family:Hind;"
      >The argument in favor of using filler text this your goes something like this <br> review point you’ll end up reviewing lorem and negotiating.  
      </rs-layer>

      <a
      id="slider-1-slide-5-layer-4" 
      class="rs-layer"
      href="live-music-and-dj.html" target="_self" rel="nofollow"
      data-type="text"
      data-rsp_ch="on"
      data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:m;yo:184px,184px,54px,40px;"
      data-text="w:normal;s:19,19,17,17;l:28,28,20,18;fw:700;a:center;"
      data-padding="t:12;r:45,45,35,30;b:12;l:45,45,35,30;"
      data-border="bos:solid;boc:#ffffff;bow:1px,1px,1px,1px;bor:3px,3px,3px,3px;"
      data-frame_0="y:50,50,31,19;"
      data-frame_1="st:650;sp:500;sR:650;"
      data-frame_999="o:0;st:w;sR:7850;"
      data-frame_hover="c:#121f38;bgc:#fff;boc:#fff;bor:3px,3px,3px,3px;bos:solid;bow:1px,1px,1px,1px;"
      style="z-index:12;font-family:Cormorant;"
      >More Services! 
      </a>

      <rs-layer
      id="slider-1-slide-5-layer-11" 
      data-type="text"
      data-rsp_ch="on"
      data-xy="x:l,l,c,c;xo:50px,50px,0,0;y:m;yo:-8px,-8px,-36px,-39px;"
      data-text="w:normal;s:70,70,70,45;l:130,130,100,60;fw:700;a:center;"
      data-frame_0="x:50,50,31,19;"
      data-frame_1="st:240;sp:800;sR:240;"
      data-frame_999="o:0;st:w;sR:7960;"
      style="z-index:9;font-family:Cormorant;"
      >Photography Workshop 
      </rs-layer>

      <a
      id="slider-1-slide-5-layer-12" 
      class="rs-layer"
      href="contact-us.html" target="_self" rel="nofollow"
      data-type="text"
      data-rsp_ch="on"
      data-xy="x:l,l,c,c;xo:283px,283px,0,0;y:m;yo:184px,184px,120px,98px;"
      data-text="w:normal;s:19,19,17,17;l:28,28,20,18;fw:700;a:center;"
      data-padding="t:12;r:45,45,35,30;b:12;l:45,45,35,30;"
      data-border="bos:solid;boc:#c78665;bow:1px,1px,1px,1px;bor:3px,3px,3px,3px;"
      data-frame_0="y:50,50,31,19;"
      data-frame_1="st:730;sp:500;sR:730;"
      data-frame_999="o:0;st:w;sR:7770;"
      data-frame_hover="bgc:#ba7552;boc:#ba7552;bor:3px,3px,3px,3px;bos:solid;bow:1px,1px,1px,1px;"
      style="z-index:13;background-color:#c78665;font-family:Cormorant;"
      >Conatct Us! 
      </a>
      -->
        </rs-slide>

      </rs-slides>

    </rs-module>
  </rs-module-wrap>
  <!--END REVOLUTION SLIDER-->
  <section class="wel-back">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="wel-txt">
            <h3>Welcome to Sri Vaarahi Matrimony</h3>

            <p>வணக்கம். தங்கள் வருகைக்கு மனமார்ந்த மகிழ்ச்சி.</p>

            <p>
              உலகெங்கும் வாழும் தமிழ் மக்களின் வரன் தேடும் முயற்சிகளை
              ஒரே நம்பகமான வலைத்தளத்தின் மூலம் ஒன்றிணைத்து,
              சொர்க்கத்தில் நிச்சயிக்கப்படும் உயரிய திருமண பந்தத்தை
              எளிதாகவும் தெளிவாகவும் தேர்ந்தெடுக்க உதவுவதே
              <strong>ஸ்ரீ வாராஹி மேட்ரிமோனி</strong>யின் உன்னத நோக்கமாகும்.
            </p>

            <p>
              ஸ்ரீ வாராஹி அம்மனின் பரிபூரண அருளால்,
              இணை தேடி இங்கு வந்திருக்கும் அனைவருக்கும்
              அன்பும் அமைதியும் நிறைந்த சிறந்த இல்வாழ்க்கை துணை
              அமைய எங்கள் மனமார்ந்த வாழ்த்துக்கள்.
            </p>

            <!--<a class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-border ttm-icon-btn-right ttm-btn-color-darkgrey mt-20 mr-20" href="about-us.html" title="" tabindex="0">Read More<i class="fa fa-arrow-right"></i>-->
            <!--</a>-->
          </div>
        </div>
{{-- @php $otp = rand(1000, 9999); @endphp --}}

        <div class="col-lg-5">
          <div class="col-bg-img-five ttm-col-bgimage-yes ttm-bg ttm-bgcolor-white box-shadow spacing-5">
            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
            <div class="layer-content">
              <div class="section-title text-center">
                <!--section title-->
                <div class="title-header">
                  <!-- <h5>Dream</h5> -->
                  <h2 class="title">Register Now</h2>
                </div><!--section title end-->
              </div>
              <form id="request_form" name="myForm" class="request_form wrap-form clearfix" method="post"
                action="{{ route('register') }}">
                @csrf
                <div class="row">
                  <div class="col-md-12">

                    <span class="text-input select-text">
                      <select name="onbehalf" id="onbehalf" class="" required>
                        <option value="">Matrimony Profile For / யாருக்காக உருவாக்கிய சுயவிபரம்</option>
                        @foreach($onbehalfs as $r)
                          <option value="{{ $r->id }}">{{ $r->onbehalf }}</option>
                        @endforeach
                        <!--<option value="Myself">Myself</option>-->
                        <!--<option value="Daughter">Daughter</option>-->
                        <!--<option value="Brother">Brother</option>-->
                        <!--<option value="Son">Son</option>-->
                        <!--<option value="Sister">Sister</option>-->
                        <!--<option value="Relative">Relative</option>-->
                        <!--<option value="Friend">Friend</option>-->
                      </select>
                    </span>

                  </div>
                  <div class="col-lg-12">
                    <label>
                      <span class="text-input"><input name="name" type="text" value="" placeholder="Enter Name"
                          required="required"></span>
                    </label>
                  </div>
                  <div class="col-lg-12">
                    <label>
                      <span class="text-input select-text">
                        <select name="gender">
                          <option value="" selected>Gender</option>
                          <option value="Male">Male / ஆண்</option>
                          <option value="Female">Female / பெண்</option>
                        </select>
                      </span>
                    </label>
                  </div>
                  <div class="col-lg-12">
                    <label>
                      <span class="text-input"><input name="email" type="email" value="" placeholder="Enter Email"
                          required="required" autocomplete="off"></span>
                      {{-- <input type="hidden" name="otps" id="otps" value="{{ $otp }}"> --}}
                    </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <label>
                      <span class="text-input">
                        <input type="text" name="mobileno" id="mobileno" required maxlength="10"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          placeholder="Enter Phone Number" />

{{-- 
                        <div class="input-group-addon"
                          style="color: #fff;background: linear-gradient(135deg, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;position: relative;right: 0;margin-top: -14px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
                          <a href="#"><button type="button" id="btn_otp" class="btn btn-sendotp"
                              style="color: #fff;padding: 13px;"> Send OTP</button></a>
                        </div>
--}}
                      </span>
                    </label>
                  </div>
                  <div id="mobileno_valid"></div>

                  <div class="col-lg-12" style="margin-top: -25px;">
                    <label>
                      <span class="text-input" id="show_hide_password">
                        <input type="password" name="password" id="password" placeholder="Password" data-size="8" rel="gp"
                          data-character-set="a-z,A-Z,0-9,@#$%^&+=!, \[email protected]~" required
                          autocomplete="new-password">
                        <!--<span class="input-group-btn"><button type="button" class="btn btn-default btn-lg getNewPass"><span class="fa fa-refresh"></span></button></span>-->
                        <div class="input-group-addon">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>

                      </span>
                    </label>
                  </div>
                  <!--<div class="col-lg-12" style="margin-top: -15px;">-->
                  <!-- <label>-->
                  <!--  <span class="text-input" id="show_hide_password1">-->
                  <!--   <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required >-->
                  <!--   <div class="input-group-addon">-->
                  <!--   <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>-->
                  <!--   </div>-->
                  <!--  </span>-->
                  <!-- </label>-->
                  <!--</div>-->
{{-- 
                  <div class="col-lg-12" style="margin-top: -15px;">
                    <label>
                      <span class="text-input">
                        <input type="tel" id="otp" required name="otp" maxlength="4"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          placeholder="Enter OTP" title="">
                      </span>
                    </label>
                  </div>
--}}
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <label>
                      <span class="text-input">
                        <input name="radio-1" type="radio" value="Yes I Will Be There." checked="checked">By registering,
                        I agree to the <span> T&C</span> and <span>Privacy Policy</span>
                      </span>
                    </label>
                  </div>
                </div>

                <button
                  class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor w-100"
                  id="saveBtn" type="submit">Register Now</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--site-main start-->
  <div class="site-main">


    <!--features-section-->
    <section class="ttm-row features-section clearfix"
      style="background-image: url('{{ asset('assets/images/logo/premium-services-bg.jpg') }}')">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-md-12">
            <div class="featuredbox-number">
              <div class="row ttm-vertical_sep">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <h3>What Makes Sri Vaarahi Matrimony Special?</h3>
                  <p>Our technology and people ensure complete support to help you and find your partner.</p>
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                      <!--featured-icon-box-->
                      <div class="featured-icon-box icon-align-top-content text-center style1">
                        <div class="featured-icon">
                          <div
                            class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-style-rounded ttm-icon_element-size-md">
                            <!-- <i class="ttm-num ti-info"></i> -->
                            <img src="{{ asset('assets/images/flaticon') }}/2.png" class="img-fluid">
                          </div>
                          <div class="featured-content">
                            <div class="featured-title">
                              <h5><a href="{{ route('login') }}">Sign In</a></h5>
                            </div>
                            <div class="featured-desc">
                              <p>Register for free & put up your profile</p>
                            </div>
                          </div>
                        </div><!-- featured-icon-box end-->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                      <!--featured-icon-box-->
                      <div class="featured-icon-box icon-align-top-content text-center style1">
                        <div
                          class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-style-rounded ttm-icon_element-size-md">
                          <!--  <i class="ttm-num ti-info"></i> -->
                          <img src="{{ asset('assets/images/flaticon') }}/3.png" class="img-fluid">
                        </div>
                        <div class="featured-content">
                          <div class="featured-title">
                            <h5>Search</h5>
                          </div>
                          <div class="featured-desc">
                            <p>Search & find your perfect soulmate</p>
                          </div>
                        </div>
                      </div><!--featured-icon-box end-->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                      <!--featured-icon-box-->
                      <div class="featured-icon-box icon-align-top-content text-center style1">
                        <div
                          class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-style-rounded ttm-icon_element-size-md">
                          <!--  <i class="ttm-num ti-info"></i> -->
                          <img src="{{ asset('assets/images/flaticon') }}/4.png" class="img-fluid">
                        </div>
                        <div class="featured-content">
                          <div class="featured-title">
                            <h5>Connect</h5>
                          </div>
                          <div class="featured-desc">
                            <p>Select and connect with matches you like</p>
                          </div>
                        </div>
                      </div><!--featured-icon-box end-->
                    </div>
                  </div>
                </div>
                <div class="col-md-1"></div>
              </div>
            </div>
          </div>
        </div><!--row end-->
      </div>
    </section>
    <!--features-section end-->
    <!--  
      <section class="search-prof" style="background-image: url('{{ asset('assets/images/logo/search-back.png') }}');">
        <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h3>Search Matching Profile</h3>
          <p>Start your search for a perfect match</p>
          </div>
          <div class="col-md-3">
          <label>Looking for</label>
          <select name="orderby" class="select2-hidden-accessible">
            <option value="menu_order" selected="selected">Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          </div>
          <div class="col-md-2">
          <label>Age</label>
          <select name="orderby" class="select2-hidden-accessible">
            <option value="menu_order" selected="selected">Any</option>
            <option value="male">19</option>
            <option value="female">20</option>
            <option value="male">21</option>
            <option value="female">22</option>
          </select>
          </div>

          <div class="col-md-2">
          <label></label>
          <select name="orderby" class="select2-hidden-accessible" style="margin-top: 7px;">
            <option value="menu_order" selected="selected">Any</option>
            <option value="male">19</option>
            <option value="female">20</option>
            <option value="male">21</option>
            <option value="female">22</option>
          </select>

          </div>
          <div class="col-md-2">
          <label>Marital Status</label>
          <select name="orderby" class="select2-hidden-accessible">
            <option value="menu_order" selected="selected">Any</option>
            <option value="male">Never Married</option>
            <option value="female">Widowed</option>
            <option value="male">Divorced</option>
            <option value="female">Awaiting Divorce</option>
          </select>
          </div>
          <div class="col-md-3">
          <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-border ttm-icon-btn-right ttm-btn-color-darkgrey mt-20 mr-20" href="about-us.html" title="" tabindex="0" style="width: 100%;text-align: center;margin-top: 31px !important;border: none !important;font-weight: 500;">SEARCH PROFILE 
          </a>
          </div>
        </div>
        </div>
      </section> -->

    <!--team-member-section-->

    <!--team-member-section end-->


    <!--features-section-->
    <section class="ttm-row features-section clearfix"
      style="background-image: url('{{ asset('assets/images/logo/premium-services-bg.jpg') }}')">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-md-12">
            <div class="featuredbox-number">
              <div class="row ttm-vertical_sep">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <h3>Why Choose Us</h3>
                  <p>Our technology and people ensure complete support to help you and find your partner.</p>
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                      <!--featured-icon-box-->
                      <div class="featured-icon-box icon-align-top-content text-center style1">
                        <div class="featured-icon">
                          <div
                            class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-style-rounded ttm-icon_element-size-md">
                            <!-- <i class="ttm-num ti-info"></i> -->
                            <img src="{{ asset('assets/images/flaticon') }}/2.png" class="img-fluid">
                          </div>
                          <div class="featured-content">
                            <div class="featured-title">
                              <h5>Best Matches</h5>
                            </div>
                            <div class="featured-desc">
                              <p>Manually verified profiles to choose from.</p>
                            </div>
                          </div>
                        </div><!-- featured-icon-box end-->
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                      <!--featured-icon-box-->
                      <div class="featured-icon-box icon-align-top-content text-center style1">
                        <div
                          class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-style-rounded ttm-icon_element-size-md">
                          <!--  <i class="ttm-num ti-info"></i> -->
                          <img src="{{ asset('assets/images/flaticon') }}/3.png" class="img-fluid">
                        </div>
                        <div class="featured-content">
                          <div class="featured-title">
                            <h5>100% Privacy</h5>
                          </div>
                          <div class="featured-desc">
                            <p>Sri Vaarahi Matrimony website provides you a 100% secure platform to meet your life partner
                            </p>
                          </div>
                        </div>
                      </div><!--featured-icon-box end-->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                      <!--featured-icon-box-->
                      <div class="featured-icon-box icon-align-top-content text-center style1">
                        <div
                          class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-style-rounded ttm-icon_element-size-md">
                          <!--  <i class="ttm-num ti-info"></i> -->
                          <img src="{{ asset('assets/images/flaticon') }}/4.png" class="img-fluid">
                        </div>
                        <div class="featured-content">
                          <div class="featured-title">
                            <h5>Verified Profiles</h5>
                          </div>
                          <div class="featured-desc">
                            <p>Profiles are manually screened by our expert team before publishing</p>
                          </div>
                        </div>
                      </div><!--featured-icon-box end-->
                    </div>

                  </div>
                </div>
                <div class="col-md-1"></div>
              </div>
            </div>
          </div>
        </div><!--row end-->
      </div>
    </section>
    <!--features-section end-->



    <!--team-member-section end-->

    <section class="ttm-row home-cta-section bg-img9 ttm-bgcolor-darkgrey clearfix">
      <div class="container">
        <!--row-->
        <div class="row">
          <div class="col-md-6">
            <div class="row-title">
              <div class="section-title">
                <div class="title-header">
                  <h5 style="color: #fff;">எங்களை பற்றி!</h5>
                  <p>
                    ஸ்ரீ வாராஹி அம்மனின் திருவருளால், இங்கு பதிவு செய்யப்படும் அனைத்து ஜாதகங்களுக்கும்
                    மிகச் சிறந்ததும், முழுமையான பொருத்தமுடையதுமான வரன்களைத் தேர்வு செய்ய
                    எங்களால் முடிந்தவரை நேர்மையுடன் உதவுகிறோம்.
                    இங்கு பதிவு கட்டணங்களைத் தவிர, வேறு எந்த விதமான
                    புரோக்கர் கமிஷனும் நாங்கள் வசூலிப்பதில்லை.
                  </p>
                </div>
              </div>
              <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-border ttm-icon-btn-right ttm-btn-color-white"
                href="#">View details</a>
            </div>
          </div>
        </div> <!--row end-->
      </div>
    </section>
@endsection