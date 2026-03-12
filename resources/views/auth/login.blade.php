@extends('layouts.frontend')

@section('content')
<style>
#grad1 {
    background-color: #f8f9fa;
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}
#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}
h4
{
    font-size: 27px;
    color: #a0066e;
    border-bottom: 1px solid #f5f5f5;
    margin-bottom: 25px;
}
#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    padding: 0px 30px 30px;
}
textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input, select {
    font-family: inherit;
    -webkit-transition: border linear .2s,box-shadow linear .2s;
    -moz-transition: border linear .2s,box-shadow linear .2s;
    -o-transition: border linear .2s,box-shadow linear .2s;
    transition: border linear .2s,box-shadow linear .2s;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    vertical-align: middle;
    width: 100%;
    color: #000000;
    padding: 12px 15px;
    border-radius: 3px;
    font-weight: 400;
    background-color: #fff;
    text-transform: inherit;s
    font-size: 17px;
    outline: none;
    line-height: inherit;
    letter-spacing: 0px;
    border: 1px solid #585757;
}
#msform .action-button {
    width: 100px;
    background: linear-gradient(135deg, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}
 
.form-card h3
{
    font-size: 27px;
    text-transform: uppercase;
    font-weight: 600;
    color: #890566;
    border-bottom: 1px solid #f5f5f5;
    margin-bottom: 30px;
}
 
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}
 
select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 5px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 11%;
    float: left;
    position: relative
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: linear-gradient(135deg, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;
}
.card h2
{
    font-size: 30px;
    line-height: 30px;
    background: linear-gradient(
135deg
, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;
    color: #fff;
    margin: 0;
    padding: 19px 20px 5px;
}
.card p
{
    background: linear-gradient(
135deg
, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;
    color: #fff;
    padding-bottom: 10px;
    margin-bottom: 0px;
}
</style>

<section style="background-image: url('{{ asset('assets/images/logo/premium-services-bg.jpg') }}');padding-top: 20px;padding-bottom: 20px;">
    <!-- MultiStep Form -->

<form method="POST" action="{{ route('login') }}">
    @csrf
<div class="container" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-10 text-center p-0 mt-3 mb-2">
            <div class="card">
                <h2><strong>LOGIN NOW</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/bg-image/reg-back.jpg') }}" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                          <div class="form-card">
                               
    @if(session('msg'))
				<div class="alert alert-micro alert-info pastel light dark" >
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					{{ session('msg') }}
				</div>
				@endif
				@if(session('msg1'))
				<div class="alert alert-danger alert-micro">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					{{ session('msg1') }}
				</div>
				@endif
                              
       <div class="col-lg-12">
           <h4 style="margin-top: 30px;
    text-align: center;    margin-bottom: 10px;">LET'S GET STARTED NOW!</h4>
           <h6 style="color: #818491;font-weight: 400;margin-bottom: 30px;">Login and find your life partner</h6>
       </div>
         <div class="col-lg-12">
         <label style="float: left;"> Email / Mobile No </label> 
          <span class="text-input"><input type="text" name="username" id="username" value="" required="required"></span>
        </div>
        
        <div class="col-lg-12">
         <label style="float: left;"> Password </label> 
          <span class="text-input"><input type="password"  name="password" id="password" value="" required="required"></span>
        </div>
        <div class="col-md-12">
            <div class="form-check" style="float: left;margin-bottom: 20px;margin-top: 5px;">
              <!--<label class="form-check-label">-->
              <!--  <input type="checkbox" class="form-check-input" value=""> I agree to the Terms & Conditions-->
              <!--</label>-->
            </div>
        </div>
        <div class="col-md-12">
            <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor w-100 shadow-sm" style="background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%) !important; border: none; font-weight: 700; height: 50px; border-radius: 25px;" type="submit">Login</button>
        </div>
        
        <div class="col-md-12">
            <a href="#" style="color: #c1097a;position: relative;top: 16px;bottom: 10px;margin-bottom: 20px;font-size: 18px;"> Forgot Password ?</a>
        </div>
        
        <div class="col-md-12">
           <h6 style="margin-top: 24px;color: #5b5d64;font-weight: 400;"> New to Vaarahi Matrimony ? <a href="{{ route('register') }}" style="color: #c1097a;font-weight: 600;"> Register Free</a></h6> 
        </div>
                     
                 </div>
              </div>
           </div>
        </div>
    </div>
</form>
</section>
@endsection
