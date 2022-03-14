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
        height: 834px;
    }
    .fixed-btn {
        position: fixed;
        right: 10px;
        bottom: 150px;
    }

    .fixed-btn-previous {
        position: fixed;
        right: 110px;
        bottom: 150px;
    }
    #progressBar-parent {
        position: fixed;
        bottom: 0;
        width: 46%;
        right: 45px;
    }
    @media screen and (max-width:768px) {
        #heading {
            font-size: 25px;
        }
        #left-section {
            background: url('/img/new-signup-page/newRegistrationPageImage.png');
            background-size: cover;
            height: 1023px;
        }
        /* #right-section {
            margin-right: 2px !important;
        } */
        #progressBar-parent {
            width: 50% !important;
            right: 30px !important;
            bottom: 50px !important;
        }
        .fixed-btn {
            position: fixed;
            right: 20px;
            bottom: 190px;
        }

        .fixed-btn-previous {
            position: fixed;
            right: 120px;
            bottom: 190px;
        }
    }
    @media screen and (max-width:576px) {
         #left-section {
            display: none;
        }
        #heading {
            font-size: 20px;
        }
        #right-section {
            margin: 0px 20px;
        }
        #progressBar-parent {
            width: 100% !important;
            right: 32px !important;
            bottom: 0 !important;
        }
        .fixed-btn {
            position: fixed;
            right: 20px;
            bottom: 150px;
        }

        .fixed-btn-previous {
            position: fixed;
            right: 120px;
            bottom: 150px;
        }
    }


</style>
<div class="">
    <div class="row mr-auto" style="overflow-y: hidden">
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
                @if (count($errors) > 0)
                    <div style="padding: 0.75rem 3.25rem; border-radius: 14.5px;" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="msform" action="{{route("submitRegister")}}" method="POST">
                {{ csrf_field() }}
{{--                     <div class="progress">--}}
{{--                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                    </div>--}}

                    <a href="{{route("home")}}" class="w-25 mx-auto">
                        <img src="/img/contact/mapLogo.png" alt="" class="img-fluid w-25">
                    </a>
                    <fieldset>
                        <h2 id="heading">Sign up to Edventure</h2>
                        <div class="form-card">
                            <input required type="text" id="name" name="name" value="{{old('name')}}" placeholder="নাম" />
                            <span style="color:#fa9632" id="name_error"></span>
                        </div>
                        <div class="text-left ">
                            <p>1. Names should be in English alphabets (A-Z, a-z) <br>(নাম ইংরেজি অক্ষরে (A-Z, a-z) লিখতে হবে)</p>
                            <p>2. Only hyphens and dots may be used as special characters. <br> (নামের ক্ষেত্রে ইংরেজি অক্ষর ব্যতীত শুধুমাত্র ডট অথবা হাইফেন ব্যাবহার করা যাবে)</p>

                        </div>

                        <button
                                disabled
                                type="button"
                                id="name_next_btn"
                                name="name_next_btn"
                                class="btn fixed-btn next action-button"> Next
                        </button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card mt-5">
                            <input required type="number" value="{{old('phone')}}" id="phone" name="phone" placeholder="মোবাইল নাম্বার" />
                            <span style="color:#fa9632" id="phone_error"></span>
                        </div>
                        <div class="text-left">
                            <p>
                                1. Your Phone number must be a valid number that is not already associated with another account in Edventure. <br> (আপনার ফোন নম্বরটি অবশ্যই একটি কার্যকর নম্বর হতে হবে যা ইতিমধ্যেই এডভেঞ্চারে অন্য অ্যাকাউন্টের সাথে যুক্ত নয়)
                            </p>
                        </div>
                        <input type="button"
                               id="phone_next_btn"
                               disabled
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next" />
                        <input type="button"
                               id="phone_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card my-5">
                            <select
                                required
                                class="select2"
                                name="class"
                                id="class"
                                data-placeholder="শ্রেণী"
                                data-dropdown-css-class="select2-purple">
                                <option value=""></option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_6}}">Class 6</option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_7}}">Class 7</option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_8}}">Class 8</option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_9}}">Class 9</option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_10}}">Class 10</option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_11}}">Class 11</option>
                                <option value="{{\App\Enum\EducationLevel::CLASS_12}}">Class 12</option>
                            </select>
                            <span style="color:#fa9632" id="class_error"></span>
                        </div>
                        <input disabled
                               type="button"
                               id="class_next_btn"
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next" />
                        <input type="button"
                               id="class_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card my-5">
                            <select
                                required
                                class="select2"
                                name="district"
                                id="district"
                                data-placeholder="জেলা"
                                data-dropdown-css-class="select2-purple">
                                    <option value=""></option>
                                    @foreach($districts as $id => $district)
                                        <option value="{{$id}}">{{$district}}</option>
                                    @endforeach
                            </select>
                            <span style="color:#fa9632" id="district_error"></span>
                        </div>
                        <input disabled
                               type="button"
                               id="district_next_btn"
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next" />
                        <input type="button"
                               id="district_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card mt-5">
                            <input required type="email" value="{{old('email')}}" id="email" name="email" placeholder="ইমেইল"/>
                            <span style="color:#fa9632" id="email_error"></span>
                        </div>
                        <div class="text-left">
                            <p>1. Please enter a valid email ID like example@gmail.com. <br>
                                (অনুগ্রহ করে একটি কার্যকর ইমেল আইডি লিখুন যেমন: example@gmail.com)</p>
                            <p>2. In case of resetting the password, you need access to this email ID later. <br> (পাসওয়ার্ড রিসেট করার ক্ষেত্রে, আপনাকে পরে এই ইমেল আইডি অ্যাক্সেস করতে হবে)</p>

                        </div>
                        <input disabled
                               type="button"
                               id="email_next_btn"
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next" />
                        <input type="button"
                               id="email_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card mt-5">
                            <input required type="password" id="password" name="password" placeholder="পাসওয়ার্ড" />
                            <input required type="password" id="password_confirmation" name="password_confirmation" placeholder="কনফার্ম পাসওয়ার্ড" />
                            <span style="color:#fa9632" id="password_error"></span>
                        </div>
                        <div class="text-left">
                            <p>1. Your password must be of 8 letters. The letters may include A-Z, a-z, 0-9 and symbols. <br> (আপনার পাসওয়ার্ড অবশ্যই ৮ অক্ষরের হতে হবে। অক্ষরগুলিতে A-Z, a-z, 0-9 এবং প্রতীক অন্তর্ভুক্ত থাকতে পারে)</p>

                        </div>
                        <input disabled
                               type="submit"
                               id="password_next_btn"
                               name="next"
                               class="btn fixed-btn action-button"
                               value="Submit" />
                        <input type="button"
                               id="password_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous" />
                    </fieldset>
                     <!-- progressbar -->
                     <div id="progressBar-parent">
                        <ul id="progressbar" style="display: flex">
                            <li class="active" id="progress-name"><strong>নাম</strong></li>
                            <li id="progress-phone"><strong>মোবাইল নাম্বার</strong></li>
                            <li id="progress-class"><strong>শ্রেণী</strong></li>
                            <li id="progress-district"><strong>জেলা</strong></li>
                            <li id="progress-email"><strong>ইমেইল</strong></li>
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
    if($('#name').val() !== '') {
        $('#name_next_btn').prop("disabled", false);
    }

    if($('#phone').val() !== '') {
        $('#phone_next_btn').prop("disabled", false);
    }

    if($('#email').val() !== '') {
        $('#email_next_btn').prop("disabled", false);
    }

    $('#name').on('change keyup', function () {
        if($('#name').val() == '') {
            $('#name_error').html('Please Enter your name')
            $('#name_next_btn').prop("disabled", true);
        } else {
            $('#name_error').html('')
            $('#name_next_btn').prop("disabled", false);
        }
    })

    $('#phone').on('change keyup', function () {
        let phone = $('#phone').val()
        if(phone === '') {
            $('#phone_error').html('Please Enter a valid phone number')
            $('#phone_next_btn').prop("disabled", true);
        } else if(phone.length !== 11) {
            $('#phone_error').html('Phone number must be 11 digits')
            $('#phone_next_btn').prop("disabled", true);
        } else {
            $('#phone_error').html('')
            $('#phone_next_btn').prop("disabled", false);
        }
    })

    $('#class').on('change', function () {
        if($('#class').val() === '') {
            $('#class_error').html('Please choose your class')
            $('#class_next_btn').prop("disabled", true);
        } else {
            $('#class_error').html('')
            $('#class_next_btn').prop("disabled", false);
        }
    })

    $('#district').on('change', function () {
        if($('#district').val() === '') {
            $('#district_error').html('Please choose your district')
            $('#district_next_btn').prop("disabled", true);
        } else {
            $('#district_error').html('')
            $('#district_next_btn').prop("disabled", false);
        }
    })

    $('#email').on('change keyup', function () {
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let email = $('#email').val()
        if(email === '') {
            $('#email_error').html('Please Enter a valid email')
            $('#email_next_btn').prop("disabled", true);
        } else if(!email.match(regexEmail)) {
            $('#email_error').html("Email must contain '@' and '.'")
            $('#email_next_btn').prop("disabled", true);
        } else {
            $('#email_error').html('')
            $('#email_next_btn').prop("disabled", false);
        }
    })

    $('#password,#password_confirmation').on('change keyup', function () {
        let password = $('#password').val()
        let confirmPassword = $('#password_confirmation').val()
        if(password === '' || confirmPassword === '') {
            $('#password_error').html('Please Enter your password')
            $('#password_next_btn').prop("disabled", true);
        } else if (password !== confirmPassword) {
            $('#password_error').html("Confirm Password doesn't match")
            $('#password_next_btn').prop("disabled", true);
        } else if(password.length <= 8) {
            $('#password_error').html("Password must be atleast 8 character")
            $('#password_next_btn').prop("disabled", true);
        } else {
            $('#password_error').html('')
            $('#password_next_btn').prop("disabled", false);
        }
    })

    $('#password_next_btn').click(function () {
        $('#msform').submit()
    })
</script>
@endsection
