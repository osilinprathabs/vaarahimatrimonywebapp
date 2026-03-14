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

.card h2
{
    font-size: 30px;
    line-height: 30px;
    background: linear-gradient(135deg, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;
    color: #fff;
    margin: 0;
    padding: 19px 20px 5px;
}
.card p
{
    background: linear-gradient(135deg, #e00c84 0%,#a90771 50%,#5d0156 100%) !important;
    color: #fff;
    padding-bottom: 10px;
    margin-bottom: 0px;
}
</style>

<section style="background-image: url('{{ asset('assets/images/logo/premium-services-bg.jpg') }}');padding-top: 20px;padding-bottom: 20px;">
    <!-- Register Form -->

<form method="POST" action="{{ route('register') }}">
    @csrf
<div class="container" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-10 text-center p-0 mt-3 mb-2">
            <div class="card">
                <h2><strong>REGISTER NOW</strong></h2>
                <p>Fill all form fields to go to next step</p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/bg-image/reg-back.jpg') }}" class="img-fluid" style="height: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                          <div class="form-card">
                               
                @if ($errors->any())
                    <div class="alert alert-danger alert-micro">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                              
        <div class="col-lg-12">
           <h4 style="margin-top: 30px; text-align: center; margin-bottom: 10px;">LET'S GET STARTED NOW!</h4>
           <h6 style="color: #818491;font-weight: 400;margin-bottom: 30px;">Register and find your life partner</h6>
        </div>

        <div class="col-lg-12 mb-3">
            <span class="text-input select-text">
            <select name="onbehalf" id="onbehalf" class="" required>
                <option value="">Matrimony Profile For / யாருக்காக</option>
                @foreach($onbehalfs ?? [] as $onbehalf)
                    <option value="{{ $onbehalf->id }}" {{ old('onbehalf') == $onbehalf->id ? 'selected' : '' }}>{{ $onbehalf->onbehalf }}</option>
                @endforeach
            </select>
            </span>
        </div>

        <div class="col-lg-12 mb-3">
            <span class="text-input"><input name="name" type="text" value="{{ old('name') }}" placeholder="Enter Name" required="required"></span>
        </div>

        <div class="col-lg-12 mb-3">
            <span class="text-input select-text">
            <select name="gender" required>
                <option value="">Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male / ஆண்</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female / பெண்</option>
            </select>
            </span>
        </div>

        <div class="col-lg-12 mb-3">
            <span class="text-input"><input name="email" type="email" value="{{ old('email') }}" placeholder="Enter Email" required="required"></span>
        </div>

        <div class="col-lg-12 mb-3">
             <span class="text-input"><input type="text" name="mobileno" id="mobileno" value="{{ old('mobileno') }}" required maxlength="10" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter Phone Number" /></span>
        </div>
        
        <div class="col-lg-12 mb-3">
            <span class="text-input"><input type="password" name="password" id="password" placeholder="Password" required="required"></span>
        </div>

        <div class="col-md-12 mt-4">
            <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor w-100 shadow-sm" style="background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%) !important; border: none; font-weight: 700; height: 50px; border-radius: 25px;" type="submit">Register Now</button>
        </div>
        
        <div class="col-md-12 text-center mt-3">
           <h6 style="color: #5b5d64;font-weight: 400;"> Already registered ? <a href="{{ route('login') }}" style="color: #c1097a;font-weight: 600;"> Login</a></h6> 
        </div>
                     
                 </div>
              </fieldset>
           </div>
        </div>
    </div>
</div>
</form>
</section>
@endsection
