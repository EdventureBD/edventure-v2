<x-guest-layout>
    @include('landing.header')
    <section class="header-banner pt-7">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 py-5">
                    <div class="pl-3">
                        <h3 class="text-purple text-lg font-bebas">WHO WE ARE</h3>
                        <p class="fw-600 text-xsm max-w-38 w-100 mx-auto text-purple-half">A group of passionate educators striving to make 
                            education easy, fun, and personal with the help of technology. We want to increase the accessibility of quality
                             education while empowering learners, parents, and teachers alike.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="/img/about/aboutus.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section> <!--header banner end-->
    <div class="container-fluid">
        <img src="/img/about/process.png" class="img-fluid" alt="">
    </div>

    <div class="our-exams-section text-center py-5">
        <div class="container">
            <h3 class="text-purple text-lg font-bebas">THE EDVENTURE MANIFESTO</h3>
            <p class="fw-600 text-xsm max-w-38 w-100 mx-auto text-purple-half">A group of passionate educators striving to make education easy, 
                fun, and personal with the help of technology.</p>
            <div class="row my-5">
                <div class="col-md-4">
                    <div class="single-exam p-4">
                        <img src="/img/about/pa.png"  alt="">
                        <h5 class="text-sm fw-800 mt-3">Personal Assistance</h5>
                        <p class="text-xxsm fw-400 mt-3">We focus on personalized assistance over personalized education</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-exam p-4">
                        <img src="/img/about/sc.png"  alt="">
                        <h5 class="text-sm mt-3">Seamless communication</h5>
                        <p class="text-xxsm fw-400 mt-3">Ensuring seamless communication between students and teachers is more important to us than sticking to one platform or device</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-exam p-4">
                        <img src="/img/about/te.png"  alt="">
                        <h5 class="text-sm mt-3">Time Efficiency</h5>
                        <p class="text-xxsm fw-400 mt-3">Following a rigid schedule for the sake of routine seems useless to us without the best possible use of the time</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- manifesto section end -->

    <div class="container-fluid">
        <img src="/img/about/ecosystem.png" class="img-fluid" alt="">
    </div>

    <div class="our-exams-section text-center py-5">
        <div class="container">
            
            <div class="row my-5">
                <div class="col-md-3">
                    <div class="single-exam p-4">
                        <img src="/img/about/ceo.png" class="img-fluid"  alt="">
                    </div>
                </div>
                
            </div>
            
        </div>
    </div> <!-- ceo section end -->

    @include('landing.footer')
</x-guest-layout>


