<x-landing-layout>
    @include('partials.alert')
    <section class="header-banner pt-7 container">
        <div class="container-fluid">
            <div class="pl-3">
                <h3 class="text-purple text-lg fw-400 font-bebas">CONTACT</h3>
                <p id="contact-us-banner-text" class="fw-600 text-xsm  w-100 text-purple-half">A group of passionate
                    educators striving to make education easy, fun, and personal with the help of technology. We want to
                    increase the accessibility of quality education while empowering learners, parents, and teachers
                    alike.
                </p>
            </div>
        </div>
    </section> <!--header banner end-->

    <!--Contact form -->
    <div class="container-fluid container">
        <div class="row px-3">

            <div class="shape-a">
                <div class="form-box">
                    <h3>We’d love to hear from <span>you!</span></h3>

                    <form action="{{route('store.contact.us')}}" method="POST" class="form-group">
                        @csrf
                        <input required type="text" name="name" id="name" placeholder="Enter your Name"/>

                        <br>
                        <input required type="email" name="email" id="email" placeholder="Enter your Email">

                        <br>
                        <input required type="text" name="message" id="message" placeholder="Write a Message"/>
                        <br>

                        <div id="Contact_us_action_button" class="w-80 row">
                            <button type="submit" class="btn-submit col-4 mx-3"
                                    style="border: 1px solid black">Submit
                            </button>

                            <button type="reset" class="btn-submit btn-cancel col-4 mx-3"
                                    style="border: 1px solid black">Cancel
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!--address box-->

            <div class="shape-b" id="shape-b-contact-box">
                <div class="contact-box">

                    <div class="text-box">

                        <h3>Contact <span>Information</span></h3>
                        <p>117, Kazi Nazrul Islam<br>
                            Avenue 1000 Dhaka, Dhaka
                            <br>Division, Bangladesh</p>
                        <p>Call us: +8801746483678<br>
                            We are open from Sunday - Thursday:
                            <br>
                            10:00 AM- 7:00 PM
                            <br>
                            E-mail: business@edventurebd.com</p>
                        <h4>Follow us</h4>

                        <div class="icon-box">

                            <a href="https://www.facebook.com/edventurebd" style="width: auto"
                               target="_blank">{{-- <i class="fa fa-twitter" aria-hidden="true"></i> --}}
                                <img src="/images/follow_us/FacebookWhite.png"
                                     alt="Facebook Logo" {{-- class="fa fa-twitter" --}}>
                            </a>

                            <a href="https://www.instagram.com/edventurebd/"
                               target="_blank">{{-- <i class="fa fa-linkedin" aria-hidden="true"></i> --}}
                                <img src="/images/follow_us/InstagramWhite.png" alt="Instagram Logo">
                            </a>

                            <a href="https://www.linkedin.com/company/edventurebd/"
                               target="_blank">{{-- <i class="fa fa-linkedin" aria-hidden="true"></i> --}}
                                <img src="/images/follow_us/LinkedInWhite.png" alt="LinkedIn Logo">
                            </a>
                            {{-- <a href="#"><i class="fa fa-facebook-official allign" aria-hidden="true"></i></i></a> --}}
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>

    <!--map-->
    <div class="map-container container">
        <div class="map">
            {{-- map image --}}
            <img src="img/contact/map.webp" alt="map" width="100%" class="img-fluid">
            {{-- building image
            <img src="img/contact/imageopt_2.png" alt="building" width="50%" class="img-fluid building"> --}}
            {{-- parl owl iconic image  --}}
            <a href="https://goo.gl/maps/zWsBhtSGmc3SMmBB9" title="Click me to find us on map" target="_blank">
                <img src="img/contact/mapLogoFinal.png" alt="Parl Owl Iconic Logo" width="8%"
                     class="img-fluid parlowlIconicLogo">
            </a>
        </div>
    </div>


</x-landing-layout>


