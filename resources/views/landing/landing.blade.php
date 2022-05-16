<x-landing-layout>
    {{-- swiper cdn link  --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    {{-- swiper cdn link --}}

    {{-- custom css link --}}
    <link rel="stylesheet" href="/css/landing-page.css">
    {{-- custom css link  --}}

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
            <h4 class="text-white  text-sm">Hey, {{Auth::user()->name}} !</h4>
            <h4 class="text-white  text-sm">Welcome to the Edventure.</h4>
            <h2 class="text-sm fw-800 mb-2 text-white">প্রস্তুতি হোক <br> নিজের মতো<h2>
            <a href="{{route('model.exam')}}" class="text-xsm btn text-white custom-submit-btn px-4">Go For Exam</a>
            @else
            <div id="landing_greeting_and_register_button">
                <div>
                    <h4 class="text-white  text-md font-roboto">Edventure-এর সাথে</h4><br>
                    <h2 class="text-lg fw-800 font-roboto text-white">প্রস্তুতি হোক <br> নিজের মতো</h2>
                </div>
                <div>
                    <a href="{{route('register')}}" class="font-roboto text-xsm btn btn-register custom-submit-btn px-md-4 my-md-4 py-md-3">REGISTER NOW</a>
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
            {{-- inner contents starts --}}
            <div class="d-flex align-items-center flex-sm-column flex-md-row my-0 py-0" id="syllabus-mapping">
                <div class="d-flex justify-content-sm-center justify-content-md-start card-main-image" style="width: 65%">
                    <div class="w-100 d-flex justify-content-start m-5">
                        <img src="/img/landing/newLanding/roadMap.png" alt="roadmap" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column card-main-info" style="width: 35%" id="card-main-info-1">
                    <div class="w-25 ml-md-auto mr-md-5">
                        <img src="/img/medical_camp/medicamp11.png" alt="" class="img-fluid">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-xmd fw-800 text-right mt-3">সিলেবাস ম্যাপিং</h4>
                        <p class="text-xsm fw-400 text-gray text-right">পরীক্ষার প্রস্তুতিতে বসে সিলেবাসের মহাসমুদ্রে যাতে হারিয়ে না যাও- সেজন্য আমরা পুরো সিলেবাসকে ম্যাপ করে দিচ্ছি</p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center flex-sm-column flex-md-row-reverse my-0 py-0" id="weakness-detection">
                <div class="d-flex justify-content-end card-main-image" style="width: 65%">
                    <div class="w-100 d-flex justify-content-end m-5">
                        <img src="/img/landing/newLanding/mobileDashboard.png" alt="roadmap" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column card-main-info" style="width: 35%" id="card-main-info-2">
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
                <div class="d-flex justify-content-start card-main-image" style="width: 65%">
                    <div class="w-100 d-flex justify-content-start m-5">
                        <img src="/img/landing/newLanding/socialGroup.png" alt="discussion banner image" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column card-main-info" style="width: 35%" id="card-main-info-3">
                    <div class="w-25 ml-auto mr-5">
                        <img src="/img/medical_camp/medicamp31.png" alt="" class="img-fluid">
                    </div>
                    <div class="mx-5">
                        <h4 class="text-xmd fw-800 text-right mt-3">টিচারদের সাথে পারসোনাল সেশন</h4>
                        <p class="text-xsm fw-400 text-gray text-right">দেশসেরা শিক্ষকদের সাথে পারসোনাল সেশন বুক করে তোমার সমস্যা শেয়ার করতে পারো, সমাধান দিবে তারাই!</p>
                    </div>
                </div>
            </div>
            {{-- inner contents ends  --}}
        </div>
        {{-- swiper part starts --}}

        @if(count($social_group) > 0)
        <section>
            <div class="social-media-parent-container">
                <h2 id="social-media-heading">Join us on Facebook Group</h2>
            </div>
            <div class="main">
                <div class="swiper swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($social_group as $group)
                            <div class="swiper-slide">
                                <div class="card">
                                    <img src="{{Storage::url('socialBanner/'.$group->banner)}}" alt="">

                                    <div style="background-color:#6400C8" class="card-body d-flex justify-content-between text-white">
                                      <h6 class="card-title">{{$group->title}}</h6>
                                      <a target="_blank" style="border-radius: 15px;" href="{{$group->link}}" class="btn text-white custom-submit-btn">Join</a>
                                    </div>
                                  </div>
                            </div>
                        @endforeach
{{--                        <div class="swiper-slide">--}}
{{--                            <div class="card">--}}
{{--                                <img src="https://media.istockphoto.com/photos/lens-image-dslr-manhattan-downtown-city-new-york-hand-picture-id901169654?k=20&m=901169654&s=612x612&w=0&h=BEzK22AQ7PrtCrIrIL92l7YvENVBLqE7Qurxu4m5iD4=" alt="">--}}

{{--                                <div style="background-color:#6400C8" class="card-body d-flex justify-content-between text-white">--}}
{{--                                  <h6 class="card-title">English for today with Zaki</h6>--}}
{{--                                  <a style="border-radius: 15px;" href="#" class="btn btn-orange-customed">Click To Join</a>--}}
{{--                                </div>--}}
{{--                              </div>--}}
{{--                        </div>--}}
{{--                        <div class="swiper-slide">--}}
{{--                            <div class="card">--}}
{{--                                <img src="https://media.istockphoto.com/photos/lens-image-dslr-manhattan-downtown-city-new-york-hand-picture-id901169654?k=20&m=901169654&s=612x612&w=0&h=BEzK22AQ7PrtCrIrIL92l7YvENVBLqE7Qurxu4m5iD4=" alt="">--}}

{{--                                <div style="background-color:#6400C8" class="card-body d-flex justify-content-between text-white">--}}
{{--                                  <h6 class="card-title">English for today with Zaki</h6>--}}
{{--                                  <a style="border-radius: 15px;" href="#" class="btn btn-orange-customed">Click To Join</a>--}}
{{--                                </div>--}}
{{--                              </div>--}}
{{--                        </div>--}}
{{--                        <div class="swiper-slide">--}}
{{--                            <div class="card">--}}
{{--                                <img src="https://media.istockphoto.com/photos/lens-image-dslr-manhattan-downtown-city-new-york-hand-picture-id901169654?k=20&m=901169654&s=612x612&w=0&h=BEzK22AQ7PrtCrIrIL92l7YvENVBLqE7Qurxu4m5iD4=" alt="">--}}

{{--                                <div style="background-color:#6400C8" class="card-body d-flex justify-content-between text-white">--}}
{{--                                  <h6 class="card-title">English for today with Zaki</h6>--}}
{{--                                  <a style="border-radius: 15px;" href="#" class="btn btn-orange-customed">Click To Join</a>--}}
{{--                                </div>--}}
{{--                              </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
            <script>
                var swiper = new Swiper(".swiper-container", {
                    slidesPerView: 'auto',
                    spaceBetween: 200,
                    centeredSlides: true,
                    grabCursor: true,
                    loop: true,
                    speed: 3000,
                    // effect: "cube",
                    // grabCursor: true,
                    // cubeEffect: {
                    //     shadow: true,
                    //     slideShadows: true,
                    //     shadowOffset: 20,
                    //     shadowScale: 0.94,
                    // },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
                // document.getElementByClassName("card-body").style.min-height = 'null';
                // document.getElementsByClassName('class-name')
            </script>
        </section>
        @endif
        {{-- swiper part ends  --}}
    </div>
</x-landing-layout>


