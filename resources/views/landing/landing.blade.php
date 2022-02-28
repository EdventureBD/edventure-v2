<x-landing-layout>
    {{-- Landing Section for General Students/HSC/SSC Students --}}
    {{-- <section class="header-banner bg-art pt-7">
        <div class="container">
            <div class="row">
                <div class="col-md-6 py-md-5">
                    <div class="pl-3">
                        @auth
                        <h4 class="text-purple  text-sm font-roboto">Hello, {{Auth::user()->name}} !</h4>
                        <h4 class="text-red  text-sm font-roboto">You have Successfully logged into HSC 2022 Last Minute Preparation Bundle.</h4>
                        <h2 class="text-sm fw-800 font-roboto mb-2 text-purple">To give exam, Visit Your Dashboard.<h2>
                        <a href="{{route('profile')}}" class="font-roboto border-none text-xxsm btn btn-register text-white bg-gradient-purple px-4">My Dashboard <i class="fa fa-arrow-right icon"></i></a>
                        @else
                        <div id="landing_greeting_and_register_button">
                            <div>
                                <h4 class="text-red  text-md font-roboto">HSC 2022</h4>
                                <h2 class="text-lg fw-800 font-roboto text-purple">প্রস্তুতি হোক<br/>
                                নিজের মতো</h2>
                            </div>
                            <div>
                                <a href="{{route('register')}}" class="font-roboto border-none text-xxsm btn btn-register text-white bg-gradient-purple px-md-5 my-md-4 py-md-4">REGISTER NOW <i class="fa fa-arrow-right icon"></i></a>
                            </div>
                        </div>
                        @endauth

                    </div>
                </div>
                <div class="col-md-6">
                    <img src="/img/landing/top-banner-final.webp" class="img-fluid" alt="Top banner Image">
                </div>
            </div>
        </div>
    </section> --}} <!--header banner end-->
    {{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        ===========================Medical Campaign========================================
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
    {{-- Medical Campaign part for landing page starts Here! --}}
    <section class="relative" id="landing-image-new" style="">
        <div class="">
            <div class="d-flex justify-content-start" >
                {{-- <div class="col-md-5 col-sm-6 py-md-5"> --}}
                <div>
                    <div class="mt-0" id="text-in-landing">
                        @auth
                        <h4 class="text-white  text-sm font-roboto">Hey, {{Auth::user()->name}} !</h4><br>
                        <h4 class="text-white  text-sm font-roboto">Welcome to the Edventure.</h4>
                        <h2 class="text-sm fw-800 font-roboto mb-2 text-white">প্রস্তুতি হোক <br> নিজের মতো<h2><br>
                        <a href="{{route('profile.modelTest')}}" class="font-roboto border text-xsm btn btn-register btn-orange-customed text-white px-4">Go to Dashboard</a>
                        @else
                        <div id="landing_greeting_and_register_button">
                            <div>
                                <h4 class="text-white  text-md font-roboto">Edventure-এর সাথে</h4><br>
                                <h2 class="text-lg fw-800 font-roboto text-white">প্রস্তুতি হোক <br> নিজের মতো</h2>
                            </div>
                            <div>
                                <a href="{{route('register')}}" class="font-roboto text-xsm btn btn-register text-white px-md-4 my-md-4 py-md-3 border" style="background: #6400c8">REGISTER NOW</a>
                            </div>
                        </div>
                        @endauth

                    </div>
                </div>
                {{-- <div class="col-md-7 col-sm-6"> --}}
                    {{-- ++++++++++Edventure Top banner++++++++++ --}}

                    {{-- <img src="/img/landing/top-banner-final.webp" class="img-fluid" alt="Top banner Image"> --}}

                    {{-- Edventure Medical Campaign Banner --}}
                    {{-- <img src="/img/medical_camp/medicampBanner.png" class="img-fluid" alt="Top banner Image"> --}}
                {{-- </div> --}}
            </div>
        </div>
    </section>
    <!--Medical Campaign part for landing page ends Here!-->

{{--    <div class="our-exams-section text-center py-5">--}}
{{--        <div class="container">--}}
{{--            <h3 class="text-purple text-md font-roboto">আমাদের পরীক্ষা সমূহ</h3>--}}
{{--            <p class="fw-600 text-xxsm max-w-38 w-100 mx-auto text-purple-half">Edventure এর সাথে হবে জোরদার পরীক্ষার প্রস্তুতি। বেছে নাও তোমার পছন্দের টেস্ট প্রিপারেশন মডিউল</p>--}}
{{--            <div class=" @if($categories->count()>=7) course-category-js @endif course-category">--}}
{{--                @foreach($categories as $category)--}}
{{--                    @if($category->slug==$selected_category_slug)--}}
{{--                        <div id="{{$category->slug}}" onclick="myFunction(this.id)" class="mb-3 pl-3 course-category-single-js btn fw-800 text-xxsm text-white mx-1 bradius-15 bshadow-medium btn-orange-customed ">{{$category->title}}</div>--}}
{{--                    @else--}}
{{--                        <div id="{{$category->slug}}" onclick="myFunction(this.id)" class="mb-3 pl-3 course-category-single-js btn fw-800 text-xxsm text-purple mx-1 bradius-15 bshadow-medium bg-white ">{{$category->title}}</div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                <div id="stop-click" >--}}
{{--                   --}}
{{--                </div>--}}
{{--            </div>--}}
{{--            --}}
{{--            <div id="loading_gif" class="container" style="display: none">--}}
{{--                <img src="/img/landing/loading.gif" alt="">--}}
{{--            </div>--}}
{{--            <div id="show-course-js" class="row justify-content-center my-5 ">--}}
{{--                @foreach ($courses as $course)--}}
{{--                <div class="col-md-4 col-lg-3 mb-3">--}}
{{--                    <div class="single-exam mx-auto text-center p-4 mb-4 mb-md-0" style="background-image: url({{asset($course->banner)}}); " >--}}
{{--                        <img src="{{asset($course->icon)}}" width="50" alt="">--}}
{{--                        <h5 class="text-sm mt-2">{{$course->title}}</h5>--}}
{{--                        <p class="text-md mt-2 fw-600 text-price">{{$course->price}}৳</p>--}}
{{--                        <a href="{{route('course-preview', $course->slug)}}" class="btn btn-outline text-purple mt-2">Go To Exam</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--               @endforeach--}}
{{--                --}}
{{--            </div>--}}
{{--            <a href="{{route('about_us')}}" class="btn text-xxsm text-white btn-orange-customed px-4 py-2">Learn more about us</a>--}}
{{--        </div>--}}
{{--    </div> <!-- our exam section end -->--}}


    <div class="our-package-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-md font-roboto">কি পাবে আমাদের প্ল্যাটফর্মে</h3>
            <p class="fw-600 text-xxsm max-w-38 w-100 mx-auto text-purple-half">- স্বয়ংক্রিয় ড্যাশবোর্ডের সাহায্যে নিজের Strength এবং Weakness মূল্যায়ন করার উপায়
                - ডিজিটাল রিপোর্টের মাধ্যমে নিমিষেই জেনে যাবে এক্সামের সকল খুঁটিনাটি বিষয়
                - দেশসেরা অভিজ্ঞ শিক্ষকের সল্‌ভ ক্লাস ও সাজেশন
                </p>
            <div class="single-package bg-art py-5 px-3 mt-6">
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
                        <img src="/img/medical_camp/medicamp12.png" class=" img-fluid" alt="Roadmap Image">
                    </div>
                </div>
            </div>
            <div class="single-package bg-art py-5 px-3 mt-6">
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
                        <img src="/img/medical_camp/medicamp22.png" class="img-fluid" alt="Dashboard Photo">
                    </div>
                </div>
            </div>
            <div class="single-package bg-art py-5 px-3 mt-6">
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
                        <img src="/img/medical_camp/medicamp32.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            {{-- <div class="single-package bg-art py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="/img/landing/solution.png" class=" img-fluid" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="ml-4">
                        <div class="package-icon text-left"><img src="/img/landing/video_icon.png" class="img-fluid" alt="video" /></div>
                        <h4 class="text-xmd fw-800 text-left mt-3">সল্‌ভ ক্লাস ও সাজেশন</h4>
                        <p class="text-xsm fw-400 text-gray text-left mt-3">প্রতিটি পরীক্ষার পর থাকছে অভিজ্ঞ শিক্ষকের সল্‌ভ ক্লাস ও সাজেশন</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div><!--our package section end-->
<?php /*
    <div class="our-exams-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-lg fw-400 font-bebas">Featured Videos</h3>
            <p class="fw-600 text-xsm max-w-38 w-100 mx-auto text-purple-half">A few simple steps separate you from your
                upcoming journey. See how easy it is to learn.  </p>
            @include('landing.videos')
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="text-purple text-lg fw-400 font-bebas">Blog</h3>
                    <p class="fw-600 text-xsm max-w-38 w-100 mx-auto text-purple-half">বদলে যাচ্ছে পৃথিবী , বাড়ছে জ্ঞানের পরিধি, সেই সাথে বদলে যাচ্ছে আমাদের
                        শেখার ধরন । সাধারণত ক্লাস লেকচার আর বই থেকে শুরু হয় আমাদের শেখার যাত্রা , কিন্তু আমাদের আশেপাশের মানুষের অভিজ্ঞতা আর সুচিন্তিত মতামত
                        থেকে এই যাত্রায় যুক্ত হয় নিজস্ব উপলব্ধি। বদলে যেতে থাকা পৃথিবী ও সমাজব্যবস্থার মাঝে প্রতিটি শিক্ষার্থী যেন নিজের মত তার শিখন যাত্রার ধরণ বুঝতে পারে এবং
                        সেভাবে কাজ করতে পারে তার প্রয়াস
                        থেকেই আমাদের ব্লগ গুলো লেখা</p>
                    <a href="#" class="btn text-xxsm fw-800 text-white bg-purple px-4 py-2">SEE ALL BLOG</a>
                </div>
                <div class="col-md-8">
                    <div class="row mt-5 mt-md-0 mb-4 align-items-center">
                        <div class="col-12">
                            <div class="single-reader">
                                {{-- <iframe  class="h-18" width="100%" height="auto" src="https://www.youtube.com/embed/vQkXF5__TQI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                <div class="single-blog overlay  bradius-10">
                                    <img src="/img/landing/blog1.png" class="img-fluid bradius-10" alt="">
                                    <div class="blog-info text-right p-3 w-100">
                                        <h3 class="text-xsm text-white">শেখার যাদু-লার্নিং এনালিটিক্স</h3>
                                        <h4 class="text-xxxsm text-white">কি এবং কেন দরকার?</h2>
                                        <div class="blog-author d-inline-block">
                                            <img src="/img/landing/blog_author.png" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="single-blog overlay  bradius-10">
                                <img src="/img/landing/blog1.png" class="bradius-10 img-fluid" alt="">
                                <div class="blog-info text-right p-3 w-100">
                                    <h3 class="text-xxsm text-white">শেখার যাদু-লার্নিং এনালিটিক্স</h3>
                                    <h4 class="text-xxxsm text-white">কি এবং কেন দরকার?</h2>
                                    <div class="blog-author d-inline-block">
                                        <img src="/img/landing/blog_author.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="single-blog overlay  bradius-10">
                                <img src="/img/landing/blog1.png" class="img-fluid bradius-10" alt="">
                                <div class="blog-info text-right p-3 w-100">
                                    <h3 class="text-xxsm text-white">শেখার যাদু-লার্নিং এনালিটিক্স</h3>
                                    <h4 class="text-xxxsm text-white">কি এবং কেন দরকার?</h2>
                                    <div class="blog-author d-inline-block">
                                        <img src="/img/landing/blog_author.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- our reader section end -->
*/ ?>

</x-landing-layout>


