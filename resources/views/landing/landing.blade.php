<x-landing-layout>
    
    <section class="header-banner bg-art pt-7">
        <div class="container">
            <div class="row">
                <div class="col-md-6 py-5">
                    <div class="pl-3">
                        @auth
                        <h4 class="text-purple  text-sm font-roboto">Hello, {{Auth::user()->name}} !</h4>
                        <h4 class="text-red  text-sm font-roboto">You have Successfully logged into HSC 2021 Last Minute Preparation Bundle.</h4>
                        <h2 class="text-sm fw-800 font-roboto mb-2 text-purple">To give exam, Visit Your Dashboard.<h2>
                        <a href="{{route('profile')}}" class="font-roboto border-none text-xxsm btn btn-register text-white bg-gradient-purple px-4">My Dashboard <i class="fa fa-arrow-right icon"></i></a>
                        @else
                        <h4 class="text-red  text-md font-roboto">HSC 2021</h4>
                        <h2 class="text-lg fw-800 font-roboto text-purple">প্রস্তুতি হোক<br/>
                        নিজের মতো</h2>
                        <a href="{{route('register')}}" class="font-roboto border-none text-xxsm btn btn-register text-white bg-gradient-purple px-4">REGISTER NOW <i class="fa fa-arrow-right icon"></i></a>
                        @endauth
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="/img/landing/top_banner.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section> <!--header banner end-->

    <div class="our-exams-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-md font-roboto">আমাদের পরীক্ষা সমূহ</h3>
            <p class="fw-600 text-xxsm max-w-38 w-100 mx-auto text-purple-half">এবার Edventure এর HSC-2021 Last Minute Prep Bundle<br> এর সাথে হবে জোরদার প্রস্তুতি</p>
            <div class="course-category-js-temp ">
                @foreach($categories as $category)
                    @if($category->slug==$selected_category_slug)
                        <div id="{{$category->slug}}" onclick="myFunction(this.id)" class="mb-3 pl-3 course-category-single-js btn fw-800 text-xxsm text-white mx-1 bradius-15 bshadow-medium bg-purple ">{{$category->title}}</div>
                    @else
                        <div id="{{$category->slug}}" onclick="myFunction(this.id)" class="mb-3 pl-3 course-category-single-js btn fw-800 text-xxsm text-purple mx-1 bradius-15 bshadow-medium bg-white ">{{$category->title}}</div>
                    @endif
                @endforeach
            </div>
            <div id="loading_gif" class="container" style="display: none">
                <img src="/img/landing/loading.gif" alt="">
            </div>
            <div id="show-course-js" class="row justify-content-center my-5 ">
                @foreach ($courses as $course)
                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="single-exam mx-auto text-center p-4 mb-4 mb-md-0" style="background-image: url({{asset($course->banner)}}); " >
                        <img src="{{asset($course->icon)}}" width="50" alt="">
                        <h5 class="text-sm mt-2">{{$course->title}}</h5>
                        <p class="text-md mt-2 fw-600 text-price">{{$course->price}}৳</p>
                        <a href="{{route('course-preview', $course->slug)}}" class="btn btn-outline text-purple mt-2">Go To Exam</a>
                    </div>
                </div>
               @endforeach
                
            </div>
            <a href="{{route('about_us')}}" class="btn text-xxsm text-white bg-purple px-4 py-2">Learn more about us</a>
        </div>
    </div> <!-- our exam section end -->

    <div class="our-package-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-md font-roboto">কী থাকছে HSC 2021 <br>Last Minute Prep Bundle এ</h3>
            <p class="fw-600 text-xxsm max-w-38 w-100 mx-auto text-purple-half">- ৩টি পূর্ণাঙ্গ  মডেল টেস্ট
- স্বয়ংক্রিয় ড্যাশবোর্ডের সাহায্যে নিজের Strength এবং Weakness মূল্যায়ন করার উপায়
- ডিজিটাল রিপোর্টের মাধ্যমে দেশের সকল পরীক্ষার্থীদের মাঝে নিজের অবস্থান যাচাই করার সুযোগ
- অভিজ্ঞ শিক্ষকের সল্‌ভ ক্লাস ও সাজেশন</p>
            <div class="single-package bg-art py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ml-4">
                            <div class="package-icon text-left"><img src="/img/landing/exam_icon.png" class="img-fluid" alt="exam" /></div>
                            <h4 class="text-xmd fw-800 text-left mt-3">অনলাইন মডেল টেস্ট</h4>
                            <p class="text-xsm fw-400 text-gray text-left">মাস্টার ট্রেইনার দ্বারা প্রণীত প্রশ্নপত্রে, 
পদার্থবিজ্ঞান, রসায়ন, জীববিজ্ঞান, এবং গণিতের ৩টি পূর্ণাঙ্গ মডেল টেস্ট</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="/img/landing/exam.png" class=" img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="single-package bg-art py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ml-4">
                        <div class="package-icon text-left"><img src="/img/landing/dashboard_icon.png" class="img-fluid" alt="Result" /></div>
                        <h4 class="text-xmd fw-800  text-left mt-3">স্বয়ংক্রিয় ড্যাশবোর্ড</h4>
                        <p class="text-xsm fw-400 text-gray text-left mt-3">এনালিটিক্স ইঞ্জিন প্রতিটি পরীক্ষার্থীর ড্যাশবোর্ডে তুলে ধরবে তার দুর্বলতা এবং সক্ষমতা, যার মাধ্যমে Preparation হবে সবচেয়ে জোরদার.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="/img/landing/dashboard.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="single-package bg-art py-5 px-3 mt-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ml-4">
                        <div class="package-icon text-left"><img src="/img/landing/result_icon.png" class="img-fluid" alt="Result" /></div>
                        <h4 class="text-xmd fw-800  text-left mt-3">ডিজিটাল রিপোর্ট</h4>
                        <p class="text-xsm fw-400 text-gray text-left mt-3">পরীক্ষা দেয়া মাত্রই ডিজিটাল রিপোর্টের সাহায্যে জেনে নিতে পারবে বাকি পরীক্ষার্থীদের মধ্যে তুলনামূলক অবস্থান</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="/img/landing/results.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="single-package bg-art py-5 px-3 mt-6">
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
            </div>
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


