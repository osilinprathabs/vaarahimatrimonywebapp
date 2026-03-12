@extends('layouts.frontend')

@section('styles')
<style>
.featured-icon-box.style8 .ttm-icon i {
    font-size: 40px;
    color: #cc0a7d;
    margin-top: 10px;
}     
</style>
@endsection

@section('content')
<div class="ttm-page-title-row">
    <div class="ttm-page-title-row-inner pb-150 res-991-pb-60 ttm-bgcolor-darkgrey">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-title-heading">
                        <h2 class="title">Contact Us</h2>
                    </div>
                    <div class="heading-seperator">
                        <span></span>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span>
                            <a title="Homepage" href="{{ url('/') }}">Home</a>
                        </span>
                        <span class="ttm-bread-sep">&gt;</span>
                        <span>Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>                    
</div>

<section class="ttm-row contact-us-section bg-layer-equal-height clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="ttm-col-bgcolor-yes ttm-bg">
                            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                            <div class="layer-content">
                                <div class="section-title without-seperator">
                                    <div class="title-header">
                                        <h5>Vaarahi Matrimony</h5>
                                        <h2 class="title">It’s Your Turn</h2>
                                    </div>
                                </div>
                                <p>இங்கு பதிவு கட்டணங்களை தவிர வேற எந்த வித புரோக்கர் கமிஷனும் நாங்கள் வாங்குவதில்லை .</p>
                                
                                <div class="featured-icon-box icon-align-before-content icon-ver_align-top style8">
                                    <div class="featured-icon">
                                        <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-sm"> 
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h5>Call Or Email</h5>
                                        </div>
                                        <div class="featured-desc">
                                            <p>info@digitalcloudies.com</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="featured-icon-box icon-align-before-content icon-ver_align-top style8">
                                    <div class="featured-icon">
                                        <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-sm"> 
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h5>Office Hours</h5>
                                        </div>
                                        <div class="featured-desc">
                                            <p>Mon – Sat: 9.00am to 7.00pm<br>Sunday: Closed</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="border pt-35 pr-30 pb-40 pl-30">
                            <h5>Get in Touch</h5>
                            <form id="contactform" class="contactform wrap-form pt-5 clearfix" method="post" action="#">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <span class="text-input"><input name="name" type="text" value="" placeholder="Your Name*" required="required"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <span class="text-input"><input name="email" type="email" value="" placeholder="Your Email*" required="required"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <span class="text-input"><input name="phone" type="text" value="" placeholder="Phone" required="required"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <span class="text-input"><input name="subject" type="text" value="" placeholder="Subject" required="required"></span>
                                        </label>
                                    </div>
                                </div>
                                <label>
                                    <span class="text-input"><textarea name="message" rows="4" placeholder="Your Messages" required="required"></textarea></span>
                                </label>
                                <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor w-100" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>             
    </div>
</section>
@endsection
