@extends('auth.new.layout')
@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <form id="msform" action="/">
                    <!-- progressbar -->
                    <ul id="progressbar" style="display: flex">
                        <li class="active" id="progress-name"><strong>নাম</strong></li>
                        <li id="progress-phone"><strong>মোবাইল নাম্বার</strong></li>
                        <li id="progress-email"><strong>জেলা</strong></li>
                        <li id="progress-district"><strong>ইমেইল</strong></li>
                        <li id="progress-password"><strong>পাসওয়ার্ড</strong></li>
                    </ul>
                    <!-- <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> --> <br> <!-- fieldsets -->
                    <fieldset>
                        <a href="{{route("home")}}" class="w-25 mx-auto">
                            <img src="/img/contact/mapLogo.png" alt="" class="img-fluid w-25">
                        </a>
                        <h2 id="heading" class="mb-5">Sign up to Edventure</h2>
                        <div class="form-card">
                            <input required type="text" name="name" placeholder="নাম" />
                        </div> 
                        <ol>
                            <li>Names should be in English alphabets (A-Z, a-z)<br> (নাম ইংরেজি অক্ষরে (A-Z, a-z) লিখতে হবে)</li>
                            <li>Only hyphens and dots may be used as special characters. <br>(নামের ক্ষেত্রে ইংরেজি অক্ষর ব্যতীত শুধুমাত্র ডট অথবা হাইফেন ব্যাবহার করা যাবে)</li>
                        </ol>
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <input required type="number" name="phone" placeholder="মোবাইল নাম্বার" /> 
                            
                        </div>
                        <ol>
                            <li>Your Phone number must be a valid number that is not already associated with another account in Edventure. (আপনার ফোন নম্বরটি অবশ্যই একটি কার্যকর নম্বর হতে হবে যা ইতিমধ্যেই এডভেঞ্চারে অন্য অ্যাকাউন্টের সাথে যুক্ত নয়)</li>
                
                        </ol>
                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <select required name="district">
                                <option value="">জেলা</option>
                                <option>Des</option>
                                <option>bides</option>
                            </select>
                        </div> 
                        <input type="button" name="next" class="next action-button" value="Next" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <input required type="email" name="email" placeholder="ইমেইল" /> 
                        </div>
                        <ol>
                            <li>Please enter a valid email ID like example@gmail.com. <br>
                                (অনুগ্রহ করে একটি কার্যকর ইমেল আইডি লিখুন যেমন: example@gmail.com)</li>
                            <li>In case of resetting the password, you need access to this email ID later. <br> (পাসওয়ার্ড রিসেট করার ক্ষেত্রে, আপনাকে পরে এই ইমেল আইডি অ্যাক্সেস করতে হবে)</li>
                        </ol>
                        <input type="button" name="next" class="next action-button" value="Next" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <input required type="password" name="password" placeholder="পাসওয়ার্ড" />
                            <input required type="password" name="confirm_password" placeholder="কনফার্ম পাসওয়ার্ড" />
                        </div> 
                        <ol>
                            <li>Your password must be of 8 letters. The letters may include A-Z, a-z, 0-9 and symbols. <br> (আপনার পাসওয়ার্ড অবশ্যই ৮ অক্ষরের হতে হবে। অক্ষরগুলিতে A-Z, a-z, 0-9 এবং প্রতীক অন্তর্ভুক্ত থাকতে পারে)</li>
                            
                        </ol>
                        <input type="button" name="next" class="next action-button" value="Submit" /> 
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection