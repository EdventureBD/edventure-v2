@extends('auth.new.layout')
@section('content')
<div class="">
    <div class="row mr-auto" style="overflow-y: hidden">
        <div class="col-md-6" id="left-section">
        </div>
        <div class="col-md-6 col-sm-12" id="right-section">
            <div class="card px-0 pt-4 pb-0">
                <p class="text-right">Already a member? <a href="{{route('login')}}" style="color: #fa9632;text-decoration:none;">Sign In</a></p>
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
                                class="btn next action-button fixed-btn-first-child"> <i class="fas fa-arrow-right"></i>
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
                        <button type="button"
                               id="phone_next_btn"
                               disabled
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next"><i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button"
                               id="phone_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous"><i class="fas fa-arrow-left"></i></button>
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
                        <button disabled
                               type="button"
                               id="class_next_btn"
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next"><i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button"
                               id="class_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous"><i class="fas fa-arrow-left"></i>
                        </button>
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
                        <button disabled
                               type="button"
                               id="district_next_btn"
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next"><i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button"
                               id="district_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous"><i class="fas fa-arrow-left"></i>
                        </button>
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
                        <button disabled
                               type="button"
                               id="email_next_btn"
                               name="next"
                               class="btn fixed-btn next action-button"
                               value="Next"><i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button"
                               id="email_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous"><i class="fas fa-arrow-left"></i>
                        </button>
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
                        <button disabled
                               type="submit"
                               id="password_next_btn"
                               name="next"
                               class="btn fixed-btn action-button"
                               value="Submit"><i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button"
                               id="password_previous_btn"
                               name="previous"
                               class="previous fixed-btn-previous action-button-previous"
                               value="Previous"><i class="fas fa-arrow-left"></i>
                        </button>
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
@endsection
