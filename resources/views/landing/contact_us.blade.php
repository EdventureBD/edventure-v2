<x-landing-layout>
    <link rel="stylesheet" href="/css/contact-us.css">
    @include('partials.alert')
    <section class="header-banner pt-7 container">
        <div class="container-fluid">
            <div class="pl-3">
                <h3 class="text-purple text-lg fw-400 font-bebas">{{__('index.contact_us')}}</h3>
                <p id="contact-us-banner-text" class="fw-600 text-xsm  w-100 text-purple-half">
                    {{__('index.contact_us_details')}}
                </p>
            </div>
        </div>
    </section>
    <!--header banner end-->

    <!--Contact form -->
    <div class="container-fluid container">
        <div class="row px-3">

            <div class="shape-a">
                <div class="form-box">
                    <h3>{{__('index.we_love_to_hear_from')}} <span>{{__('index.you')}}</span></h3>

                    <form action="{{route('store.contact.us')}}" method="POST" class="form-group">
                        @csrf
                        <input required type="text" name="name" id="name" placeholder="{{__('index.enter_your_name')}}"/>

                        <br>
                        <input required type="email" name="email" id="email" placeholder="{{__('index.enter_your_email_address')}}">

                        <br>

                        <textarea style="background: #363536; width: 83%; color: white" class="mt-5" required type="text" name="message" id="message" placeholder="Write a Message"></textarea>

                        <br>

                        <div id="Contact_us_action_button" class="w-80 row">
                            <button type="submit" class="btn-submit col-4 mx-3 d-flex justify-content-center"
                                    style="border: 1px solid black">{{__('index.submit')}}
                            </button>

                            <button type="reset" class="btn-submit btn-cancel col-4 mx-3  d-flex justify-content-center"
                                    style="border: 1px solid black">{{__('index.cancel')}}
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!--address box-->

            <div class="shape-b" id="shape-b-contact-box">
                <div class="contact-box">

                    <div class="text-box">

                        <h3>{{__('index.contact')}} <span>{{__('index.information')}}</span></h3>
                        <p>{{__('index.117_kazi_nazrul_islam')}}<br>
                             {{__('index.dhaka_1000_bangladesh')}}</p>
                        <p>{{__('index.call_us_8801746483678')}}<br>
                            {{__('index.we_are_open_from_sunday_thursday')}}
                            <br>
                            {{__('index.office_time')}}
                            <br>
                            {{__('index.email')}}: business@edventurebd.com</p>
                        <h4>{{__('index.follow_us')}}</h4>

                        <div class="icon-box">

                            <a href="https://www.facebook.com/edventurebd" style="width: auto"
                               target="_blank">
                                <img src="/images/follow_us/FacebookWhite.png"
                                     alt="Facebook Logo">
                            </a>

                            <a href="https://www.instagram.com/edventurebd/"
                               target="_blank">
                                <img src="/images/follow_us/InstagramWhite.png" alt="Instagram Logo">
                            </a>

                            <a href="https://www.linkedin.com/company/edventurebd/"
                               target="_blank">
                                <img src="/images/follow_us/LinkedInWhite.png" alt="LinkedIn Logo">
                            </a>

                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>

    <!--map-->
    <div class="map-container container">
        <div class="map mt-auto">
            <img src="img/contact/map.webp" alt="map" width="100%" class="img-fluid">
            <a href="https://goo.gl/maps/zWsBhtSGmc3SMmBB9" title="Click me to find us on map" target="_blank">
                <img src="img/contact/mapLogo.png" alt="Parl Owl Iconic Logo" width="5%"
                     class="img-fluid parlowlIconicLogo">
            </a>
        </div>
    </div>


</x-landing-layout>


