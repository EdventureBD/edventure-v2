<x-landing-layout headerBg="white">
    <style>
        #profile-dash-img{
            width: 165px;
            display:flex;
            justify-content: center
        }
        @media screen and (max-width:570px){
            #profile-dash-img{
                width: 78.5px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 15px;
            }
        }
    </style>
    <div id="parent-div" class="mt-5 pt-5 p-5">
        <div id="info-part" class="d-md-flex justify-content-between align-items-middle">
            <div class="d-md-flex justify-content-start mr-auto">
                <div class="d-md-flex" id="profile-dash-img">
                    <img src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_3.jpg" alt="profile-photo" class="img-fluid" style="border-radius: 50%">
                </div>
                <div class="d-flex flex-column justify-content-center align-top ml-3">
                    <div class="">
                        <h3>Zahid</h3>
                    </div>
                    <div class="w-100 h-0 border border-gray m-0 p-0"></div>
                    <div class="d-flex pl-3">
                        <div class="row row-cols-1 fw-800 mr-3">
                            <div>
                               Courses 
                            </div>
                            <div>
                                5
                            </div>
                        </div>
                        <div class="row row-cols-1 fw-800 ml-3">
                            <div>
                                Completed
                            </div>
                            <div>
                                3
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex max-h-10">
                <div class="px-5 py-2 border my-auto fw-800">
                    Course
                </div>
                <div class="px-5 py-2 border my-auto fw-800 text-white" style="background: #FA9632;">
                    Model Test
                </div>
            </div>
        </div>
        <div id="info-detail">

        </div>
    </div>
</x-landing-layout>
