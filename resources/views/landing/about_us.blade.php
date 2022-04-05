<x-landing-layout>

    <section class="header-banner pt-7">
        <div class="container">
            <div class="row">
                <div class="col-md-6 py-5">
                    <div class="pl-3">
                        <h3 class="text-purple text-lg fw-400 font-bebas">{{__('index.who_we_are')}}</h3>
                        <p class="fw-600 text-xsm max-w-38 w-100 text-purple-half">{{__('index.who_we_are_details')}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="/img/about/aboutus.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section> <!--header banner end-->
    <div class="my-5 container">

        <img src="/img/about/process.png" class="w-100 img-fluid" alt="">
    </div>

    <div class="our-exams-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-lg fw-400 font-bebas">{{__('index.the_edventure_manifesto')}}</h3>
            <p class="fw-600 text-xsm max-w-38 w-100 mx-auto text-purple-half">{{__('index.the_edventure_manifesto_details')}}</p>
            <div class="row my-5">
                <div class="col-md-4">
                    <div class="single-exam about mb-4 mb-md-0 h-30 p-4">
                        <img src="/img/about/pa.png" class="img-fluid"  alt="">
                        <h5 class="text-sm fw-800 mt-3 text-purple">{{__('index.personal_assistance')}}</h5>
                        <p class="text-xxsm fw-400 mt-3 text-purple-half">{{__('index.personal_assistance_details')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-exam about mb-4 mb-md-0 h-30 p-4">
                        <img src="/img/about/sc.png" class="img-fluid" alt="">
                        <h5 class="text-sm fw-800 mt-3 text-purple">{{__('index.seamless_communication')}}</h5>
                        <p class="text-xxsm fw-400 mt-3 text-purple-half">{{__('index.seamless_communication_details')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-exam about h-30  p-4">
                        <img src="/img/about/te.png" class="img-fluid" alt="">
                        <h5 class="text-sm fw-800 mt-3 text-purple">{{__('index.time_efficiency')}}</h5>
                        <p class="text-xxsm fw-400 mt-3 text-purple-half">{{__('index.time_efficiency_details')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- manifesto section end -->

    <div class="container">
        <img src="/img/about/ecosystem.png" class="w-100 img-fluid" alt="">
    </div>

    <div id="ceo_message" class=" our-exams-section py-5">
        <div class="container bg-purple-light p-4 bradius-20">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-author p-3">
                        <img src="/img/about/shahriar.png" class="w-15 mb-3 img-fluid"  alt="">
                        <h3 class="text-sm text-white fw-600">{{__('index.md_shahriar_iftekhar')}}</h3>
                        <p class="text-xsm text-white">{{__('index.ceo')}}</p>
                        <div class="mt-3 mx-4 social-icons d-flex justify-content-between">
                            <a href="https://www.facebook.com/shahriariftekher.tasfiq" target="_blank"><img src="/img/about/facebook.png" class="img-fluid"  alt="Facebook Logo"></a>
                            <a href="https://www.instagram.com/shahriar.tasfiq/" target="_blank"><img src="/img/about/instagram.png" class="img-fluid"  alt="Instagram Logo"></a>
                            <a href="https://www.linkedin.com/in/shahriar-iftekhar-53884a125/" target="_blank"><img src="/images/follow_us/LinkedInWhite.png" class="img-fluid"  alt="LinkedIn Logo"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 pl-3 pl-md-5">
                        <h3 class="text-purple text-lg fw-400 font-bebas mt-md-0 mt-2">{{__('index.message_from_the_ceo')}}</h3>
                        <p class="fw-600 text-justify text-xsm w-100 text-purple-half">{{__('index.ceo_message_details')}}
                    </p>
                </div>
            </div>

        </div>
    </div> <!-- ceo section end -->


</x-landing-layout>


