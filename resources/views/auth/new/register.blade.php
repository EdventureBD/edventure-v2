@extends('auth.new.layout')
@section('content')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .select2-purple .select2-container--default span span{
        height: 2.35rem;
    }
    div .select2 .selection .select2-selection{
        height: 2.35rem;
        border-radius: 14.29px;
    }
    .select2-container--default .select2-selection--single {
        border: 1px solid #FA9632 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #2C3E50; !important;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #FA9632;
        color: white;
    }
    .select2-container--open .select2-dropdown--below {
        border-top: none;
        border-bottom-left-radius: 15px !important;
        border-bottom-right-radius: 15px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        background: #FA9632;
        height: 100%;
        padding-left: 25px;
        padding-right: 25px;
        border-radius: 0px 14.23px 14.23px 0px;
        
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b{
        border-color: white transparent transparent transparent;
        width: 10px;
    }
    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent white transparent;
    border-width: 0 4px 5px 4px;
    
    }
    #left-section {
        background: url('/img/new-signup-page/newRegistrationPageImage.png');
        background-size: cover;
        background-position: center center;
        height: 920px;
        }
    @media screen and (max-width:768px) {
        #left-section {
            background: url('/img/new-signup-page/newRegistrationPageImage.png');
            background-size: cover;
            background-position: center center;
        }
        /* #right-section {
            margin-right: 2px !important;
        } */
        #progressBar-parent {
            width: 40% !important;
            right: 55px !important;
            bottom: 50px !important;
        }
    }
    @media screen and (max-width:576px) {
         #left-section {
            display: none;
        }
        #right-section {
            margin: 0px 10px;
        }
        #progressBar-parent {
            width: 90% !important;
            right: 30px !important;
            bottom: 0 !important;
        }
    }

    
</style>
<div class="">
    <div class="row">
        <div class="col-md-6" id="left-section">
            {{-- <img src="https://www.bennet.org/blog/responsive-images-busy-people/images/curiosity-medium.jpg" alt="Mars Curiosity Rover takes an excellent selfie."
            srcset="
                    https://www.bennet.org/blog/responsive-images-busy-people/images/curiosity-large.jpg  1120w,
                    https://www.bennet.org/blog/responsive-images-busy-people/images/curiosity-medium.jpg 720w,
                    https://www.bennet.org/blog/responsive-images-busy-people/images/curiosity-small.jpg  400w" 
            sizes="(min-width: 40em) calc(66.6vw - 4em),100vw"> --}}
        </div>
        <div class="col-md-6 col-sm-12" id="right-section">
            <div class="card px-0 pt-4 pb-0">
                <form id="msform" action="/">
                   
                    <!-- <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->  <!-- fieldsets -->
                    
                    <a href="{{route("home")}}" class="w-25 mx-auto my-5">
                        <img src="/img/contact/mapLogo.png" alt="" class="img-fluid w-25">
                    </a>
                    <fieldset>
                        <h2 id="heading" class="my-5">Sign up to Edventure</h2>
                        <div class="form-card">
                            <input required type="text" name="name" placeholder="নাম" />
                        </div> 
                        <div class="text-left my-5">
                            <p>1. Names should be in English alphabets (A-Z, a-z) <br>(নাম ইংরেজি অক্ষরে (A-Z, a-z) লিখতে হবে)</p>
                            <p>2. Only hyphens and dots may be used as special characters. <br> (নামের ক্ষেত্রে ইংরেজি অক্ষর ব্যতীত শুধুমাত্র ডট অথবা হাইফেন ব্যাবহার করা যাবে)</p>
                        
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card mt-5">
                            <input required type="number" name="phone" placeholder="মোবাইল নাম্বার" /> 
                            
                        </div>
                        <div class="text-left my-5">
                            <p>
                                1. Your Phone number must be a valid number that is not already associated with another account in Edventure. <br> (আপনার ফোন নম্বরটি অবশ্যই একটি কার্যকর নম্বর হতে হবে যা ইতিমধ্যেই এডভেঞ্চারে অন্য অ্যাকাউন্টের সাথে যুক্ত নয়)
                            </p>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card my-5">
                            <select
                                class="select2"
                                name="district"
                                id="district"
                                data-placeholder="জেলা"
                                data-dropdown-css-class="select2-purple">
                                    <option value=""></option>
                                    <option>Des</option>
                                    <option>bides</option>
                            </select>
                        </div> 
                        <input type="button" name="next" class="next action-button" value="Next" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card mt-5">
                            <input required type="email" name="email" placeholder="ইমেইল" /> 
                        </div>
                        {{-- <ol>
                            <li>Please enter a valid email ID like example@gmail.com. <br>
                                (অনুগ্রহ করে একটি কার্যকর ইমেল আইডি লিখুন যেমন: example@gmail.com)</li>
                            <li>In case of resetting the password, you need access to this email ID later. <br> (পাসওয়ার্ড রিসেট করার ক্ষেত্রে, আপনাকে পরে এই ইমেল আইডি অ্যাক্সেস করতে হবে)</li>
                        </ol> --}}
                        <div class="text-left my-5">
                            <p>1. Please enter a valid email ID like example@gmail.com. <br>
                                (অনুগ্রহ করে একটি কার্যকর ইমেল আইডি লিখুন যেমন: example@gmail.com)</p>
                            <p>2. In case of resetting the password, you need access to this email ID later. <br> (পাসওয়ার্ড রিসেট করার ক্ষেত্রে, আপনাকে পরে এই ইমেল আইডি অ্যাক্সেস করতে হবে)</p>
                        
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card mt-5">
                            <input required type="password" name="password" placeholder="পাসওয়ার্ড" />
                            <input required type="password" name="confirm_password" placeholder="কনফার্ম পাসওয়ার্ড" />
                        </div> 
                        <div class="text-left my-5">
                            <p>1. Your password must be of 8 letters. The letters may include A-Z, a-z, 0-9 and symbols. <br> (আপনার পাসওয়ার্ড অবশ্যই ৮ অক্ষরের হতে হবে। অক্ষরগুলিতে A-Z, a-z, 0-9 এবং প্রতীক অন্তর্ভুক্ত থাকতে পারে)</p>
                            
                        </div>
                        <input type="button" name="next" class="next action-button" value="Submit" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                     <!-- progressbar -->
                     <div style="position: fixed; bottom: 0;width: 46%;right: 25px;" id="progressBar-parent">
                        <ul id="progressbar" style="display: flex">
                            <li class="active" id="progress-name"><strong>নাম</strong></li>
                            <li id="progress-phone"><strong>মোবাইল নাম্বার</strong></li>
                            <li id="progress-email"><strong>জেলা</strong></li>
                            <li id="progress-district"><strong>ইমেইল</strong></li>
                            <li id="progress-password"><strong>পাসওয়ার্ড</strong></li>
                        </ul>
                     </div>
                     
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $('.select2').select2()
</script>
@endsection
