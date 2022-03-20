<x-landing-layout>
    
    {{-- new landing banner part starts --}}
    <section class="position-fixed w-100">
        <div class="row pt-5 pb-0 mx-0 px-0 my-0 ">
            <div class="col-5 p-0 m-0">
                <img src="/img/landing/newLanding/landingImageBigScreenText.webp" alt="text-part's Background" class="img-fluid h-75 w-100">
            </div>
            <div class="col-7 p-0 m-0">
                <img src="/img/landing/newLanding/landingImageBigScreen.webp" alt="photo part in landing" class="img-fluid h-75 w-100">
            </div>
        </div>
        <div class="mt-0" id="text-in-landing">
            @auth
            <h4 class="text-white  text-sm font-roboto">Hey, {{Auth::user()->name}} !</h4>
            <h4 class="text-white  text-sm font-roboto">Welcome to the Edventure.</h4>
            <h2 class="text-sm fw-800 font-roboto mb-2 text-white">প্রস্তুতি হোক <br> নিজের মতো<h2>
            <a href="{{route('model.exam')}}" class="font-roboto text-xsm btn btn-register btn-orange-customed px-4">Go For Exam</a>
            @else
            <div id="landing_greeting_and_register_button">
                <div>
                    <h4 class="text-white  text-md font-roboto">Edventure-এর সাথে</h4><br>
                    <h2 class="text-lg fw-800 font-roboto text-white">প্রস্তুতি হোক <br> নিজের মতো</h2>
                </div>
                <div>
                    <a href="{{route('register')}}" class="font-roboto text-xsm btn btn-register btn-orange-customed px-md-4 my-md-4 py-md-3">REGISTER NOW</a>
                </div>
            </div>
            @endauth

        </div>
    </section>
    {{-- new landing banner part ends --}}
    <div class="our-package-section text-center py-5 position-relative bg-white">
        <div class="">
            <h3 class="text-dark text-md font-roboto mb-5">কী পাবে আমাদের প্ল্যাটফর্মে</h3>
            <p class="fw-600 text-xxsm max-w-100 w-100 mx-auto text-dark">- স্বয়ংক্রিয় ড্যাশবোর্ডের সাহায্যে নিজের Strength এবং Weakness মূল্যায়ন করার উপায়</p>
            <p class="fw-600 text-xxsm max-w-100 w-100 mx-auto text-dark">- ডিজিটাল রিপোর্টের মাধ্যমে নিমিষেই জেনে যাবে এক্সামের সকল খুঁটিনাটি বিষয়</p>
            <p class="fw-600 text-xxsm max-w-100 w-100 mx-auto text-dark">- দেশসেরা অভিজ্ঞ শিক্ষকের সল্‌ভ ক্লাস ও সাজেশন</p>
            {{-- <div class="single-package py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ml-4">
                            <div class="package-icon text-left"><img src="/img/medical_camp/medicamp11.png" class="img-fluid" alt="roadmap icon" /></div>
                            <h4 class="text-xmd fw-800 text-left mt-3">সিলেবাস ম্যাপিং</h4>
                            <p class="text-xsm fw-400 text-gray text-left">পরীক্ষার প্রস্তুতিতে বসে সিলেবাসের মহাসমুদ্রে যাতে হারিয়ে না যাও- সেজন্য আমরা পুরো সিলেবাসকে ম্যাপ করে দিচ্ছি
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="/img/landing/newLanding/roadMap.webp" class=" img-fluid" alt="Roadmap Image">
                    </div>
                </div>
            </div>
            <div class="single-package py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ml-4">
                        <div class="package-icon text-left"><img src="/img/medical_camp/medicamp21.png" class="img-fluid" alt="Dashboard Image" /></div>
                        <h4 class="text-xmd fw-800  text-left mt-3">টপিকভিত্তিক উইকনেস ডিটেকশন</h4>
                        <p class="text-xsm fw-400 text-gray text-left mt-3">বাংলাদেশের একমাত্র প্ল্যাটফর্ম হিসেবে Edventure এ পরীক্ষা দিয়েই জানতে পারবে ঠিক কোন চ্যাপ্টারের কোন টপিকে তুমি দুর্বল
                        </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="/img/landing/newLanding/phoneDashboard.webp" class="img-fluid" alt="Dashboard Photo">
                    </div>
                </div>
            </div>
            <div class="single-package py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ml-4">
                        <div class="package-icon text-left"><img src="/img/medical_camp/medicamp31.png" class="img-fluid" alt="Result" /></div>
                        <h4 class="text-xmd fw-800  text-left mt-3">টিচারদের সাথে পারসোনাল সেশন</h4>
                        <p class="text-xsm fw-400 text-gray text-left mt-3">দেশসেরা শিক্ষকদের সাথে পারসোনাল সেশন বুক করে তোমার সমস্যা শেয়ার করতে পারো, সমাধান দিবে তারাই!
                        </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="/img/landing/newLanding/discussionWithTeacher.webp" class="img-fluid" alt="">
                    </div>
                </div>
            </div> --}}
            <div class="d-flex align-items-center flex-sm-column flex-md-row my-0 py-0" id="syllabus-mapping">
                <div class="d-flex justify-content-sm-center justify-content-md-start" style="width: 65%">
                    <div class="w-100 d-flex justify-content-start">
                        <img src="/img/landing/newLanding/roadMap.webp" alt="roadmap" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column" style="width: 35%">
                    <div class="w-25 ml-auto mr-5">
                        <img src="/img/medical_camp/medicamp11.png" alt="" class="img-fluid">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-xmd fw-800 text-right mt-3">সিলেবাস ম্যাপিং</h4>
                        <p class="text-xsm fw-400 text-gray text-right">পরীক্ষার প্রস্তুতিতে বসে সিলেবাসের মহাসমুদ্রে যাতে হারিয়ে না যাও- সেজন্য আমরা পুরো সিলেবাসকে ম্যাপ করে দিচ্ছি</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center flex-sm-column flex-md-row-reverse my-0 py-0" id="weakness-detection">
                <div class="d-flex justify-content-end" style="width: 65%">
                    <div class="w-100 d-flex justify-content-end">
                        <img src="/img/landing/newLanding/mobileDashboard.webp" alt="roadmap" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column" style="width: 35%">
                    <div class="w-25 mx-5">
                        <img src="/img/medical_camp/medicamp21.png" alt="" class="img-fluid">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-xmd fw-800 text-left mt-3">টপিকভিত্তিক উইকনেস ডিটেকশন</h4>
                        <p class="text-xsm fw-400 text-gray text-left">বাংলাদেশের একমাত্র প্ল্যাটফর্ম হিসেবে Edventure এ পরীক্ষা দিয়েই জানতে পারবে ঠিক কোন চ্যাপ্টারের কোন টপিকে তুমি দুর্বল</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center flex-sm-column flex-md-row my-0 py-0" id="personal-session">
                <div class="d-flex justify-content-start" style="width: 65%">
                    <div class="w-100 d-flex justify-content-start">
                        <img src="/img/landing/newLanding/socialGroup.webp" alt="discussion banner image" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column" style="width: 35%">
                    <div class="w-25 ml-auto mr-5">
                        <img src="/img/medical_camp/medicamp31.png" alt="" class="img-fluid">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-xmd fw-800 text-right mt-3">টিচারদের সাথে পারসোনাল সেশন</h4>
                        <p class="text-xsm fw-400 text-gray text-right">দেশসেরা শিক্ষকদের সাথে পারসোনাল সেশন বুক করে তোমার সমস্যা শেয়ার করতে পারো, সমাধান দিবে তারাই!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>


