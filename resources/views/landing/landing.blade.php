<x-landing-layout>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <style>
       @media screen and (max-width:576px){
           p {
               font-size: 0.9rem !important;
           }
            #syllabus-mapping,#weakness-detection,#personal-session {
                flex-direction: column;
            }
            .card-main-image, .card-main-image div,.card-main-info {
                width: 100% !important;
                justify-content: center !important;
            }
            .card-main-info p {
                font-size: .95rem !important;
            }
            .card-main-info h4 {
                font-size: 1.05rem;
            }
            h3 {
                font-size: 1.45rem !important;
            }
            .our-package-section div h3 {
                margin-bottom: 15px !important;
            }
       }
       /* swiper css part starts */
       .main {
            width: 100%;
            height: 60vh;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            background: #fdfdfd;
            
        }
        .swiper-container {
            height: 535px;
           
        }
        .swiper-wrapper {
            align-items: center;
        }
        .swiper-slide {
            width: 400px;
            height: 267px;
            border-radius: 17px;
            opacity: 0.2;
        }

        .swiper-slide img{
            width: 100%;
            height: 100%;
            border-radius: 15px 15px 0 0;
        }
        .swiper-slide-active {
            transform: scale(1.2);
            transition: .84s;
            opacity: 1;
            z-index: 2;
            
        }
        .swiper-slide-active img {
            width: 100%;
            height: 100%;
        }
        .card {
                width: 100% !important;
                height: 100% !important;
                border-radius: 15px 15px 0 0;
                filter: drop-shadow(0px 103.559px 168.131px rgba(0, 0, 0, 0.100973)) drop-shadow(0px 23.1312px 37.5543px rgba(0, 0, 0, 0.149027)) drop-shadow(0px 6.88678px 11.1809px rgba(0, 0, 0, 0.25));
        }
        .card-body {
            min-height: initial !important;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        .swiper-horizontal>.swiper-pagination-bullets, .swiper-pagination-bullets.swiper-pagination-horizontal, .swiper-pagination-custom, .swiper-pagination-fraction {
            bottom: -5px !important;
        }
        
        /* swiper css part ends  */
    </style>
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
                <div class="d-flex justify-content-sm-center justify-content-md-start card-main-image" style="width: 65%">
                    <div class="w-100 d-flex justify-content-start">
                        <img src="/img/landing/newLanding/roadMap.webp" alt="roadmap" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column card-main-info" style="width: 35%">
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
                <div class="d-flex justify-content-end card-main-image" style="width: 65%">
                    <div class="w-100 d-flex justify-content-end">
                        <img src="/img/landing/newLanding/mobileDashboard.webp" alt="roadmap" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column card-main-info" style="width: 35%">
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
                    <div class="w-100 d-flex justify-content-start">
                        <img src="/img/landing/newLanding/socialGroup.webp" alt="discussion banner image" class="img-fluid">
                    </div>
                </div>
                <div class="d-flex flex-column card-main-info" style="width: 35%">
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
        {{-- swiper part starts --}}
       

            <div class="main">
                <div class="swiper swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dmlld3xlbnwwfHwwfHw%3D&w=1000&q=80" alt="">

                                <div class="card-body d-flex justify-content-between">
                                  <h5 class="card-title">Card title</h5>
                                  <a href="#" class="btn btn-primary">Click To Join</a>
                                </div>
                              </div>
                            {{-- <img src="https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dmlld3xlbnwwfHwwfHw%3D&w=1000&q=80" alt=""> --}}
                        </div>
                        <div class="swiper-slide">
                            <div class="card">
                                <img src="https://media.istockphoto.com/photos/lens-image-dslr-manhattan-downtown-city-new-york-hand-picture-id901169654?k=20&m=901169654&s=612x612&w=0&h=BEzK22AQ7PrtCrIrIL92l7YvENVBLqE7Qurxu4m5iD4=" alt="">

                                <div style="background-color:#6400C8" class="card-body d-flex justify-content-between text-white">
                                  <h5 class="card-title">Card title</h5>
                                  <a style="border-radius: 15px;" href="#" class="btn btn-orange-customed">Click To Join</a>
                                </div>
                              </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.pexels.com/photos/1421/road-nature-hand-path.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://media.istockphoto.com/photos/photography-camera-lens-concept-picture-id843408508?k=20&m=843408508&s=612x612&w=0&h=s4rhaeVZJ2nn2Aa2hQLK6ZX4NTmbHnb-ZfjsBSZUsdY=" alt="">
                        </div>
                        {{-- <div class="swiper-slide">
                            <img src="https://media.istockphoto.com/photos/lense-picture-id1264340404?k=20&m=1264340404&s=612x612&w=0&h=F95ZhcKlyy1ZTSj7AeZnXKN6O5EWe-otedcQc31wkVw=" alt="">
                        </div> --}}
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
                    // effect: "cube",
                    // grabCursor: true,
                    // cubeEffect: {
                    //     shadow: true,
                    //     slideShadows: true,
                    //     shadowOffset: 20,
                    //     shadowScale: 0.94,
                    // },
                    // autoplay: {
                    //     delay: 5500,
                    //     disableOnInteraction: false,
                    // },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
                // document.getElementByClassName("card-body").style.min-height = 'null';
                // document.getElementsByClassName('class-name')
            </script>
        </section>
        {{-- swiper part ends  --}}
    </div>
</x-landing-layout>


