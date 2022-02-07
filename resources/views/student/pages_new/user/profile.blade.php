<x-landing-layout headerBg="white">
    <style>
        #profile-dash-img{
            width: 165px;
            display:flex;
            justify-content: center;
            box-shadow: 0.821333px 0.821333px 4.10667px 1.64267px rgba(0, 0, 0, 0.1);
            border-radius: 82.1333px;
        }
        #course-option{
            box-shadow: 1.69017px 1.69017px 8.45083px 3.38033px rgba(0, 0, 0, 0.1);
            border-radius: 8.45083px 0px 0px 8.45083px;
        }
        #model-test-option {
            box-shadow: 2.48889px 2.48889px 12.4444px 4.97778px rgba(0, 0, 0, 0.1);
            border-radius: 0px 12.4444px 12.4444px 0px;
        }
        .horizontal-line{
            width: 100%;
        }
        #course-option:hover {
            background: #FA9632;
            color: white;
        }
        #model-test-option:hover {
            background: #FA9632;
            color: white;
        }
        #journey-cart {
            color: #6802C1;
            width: 100%;
            height: 134px;
            background: #FFFFFF;
            box-shadow: 1.91673px 1.91673px 9.58365px 3.83346px rgba(0, 0, 0, 0.1);
            border-radius: 9.58365px;
        }
        .category-selection{
            overflow-y: scroll;
        }
        .category-progress {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 65.96px;
            background: #6902C5;
            box-shadow: 2.48889px 2.48889px 12.4444px 4.97778px rgba(0, 0, 0, 0.1);
            border-radius: 12.4444px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .category-name {
            display: flex;
            flex-direction: column;
            padding-bottom: 0;
        }
        .category-name h5{
            margin-left: auto;
            margin-right: auto;
        }
        .progress {
            background: #FA9632;
            margin-bottom: 0;
            height: 15px;
        }
        .category-link-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20%;
            height: 65.96px;

            background: #FA9632;
            border-radius: 0px 11.041px 11.041px 0px;
        }
        .subjects {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 65.96px;
            background: #6902C5;
            box-shadow: 2.48889px 2.48889px 12.4444px 4.97778px rgba(0, 0, 0, 0.1);
            border-radius: 12.4444px;
            margin: 5px auto;
            padding-left: 15px;
            padding-right: 15px;

        }
        #info-middle-option {
            width: 100%;
            height: 449.24px;
            background: #FFFFFF;
            box-shadow: 2.48889px 2.48889px 12.4444px 4.97778px rgba(0, 0, 0, 0.1);
            border-radius: 12.4444px;
        }
        #info-right-option {
            width: 100%;
            height: 449.24px;
            background: #FFFFFF;
            box-shadow: 2.48889px 2.48889px 12.4444px 4.97778px rgba(0, 0, 0, 0.1);
            border-radius: 12.4444px;
        }
        #strength-title {
            background: #67B032;
            border: 1.96px solid #67B032;
        }
        #weakness-title {
            background: #C50902;
            border: 1.96px solid #C50902;
        }
        .strength-weakness-title-common {
            display: flex;
            justify-content: space-between;
            box-sizing: border-box;
            border-radius: 9.8px 9.8px 0px 0px;
            font-family: Inter;
            font-style: normal;
            font-weight: bold;
            font-size: 34.8444px;
            line-height: 42px;
            letter-spacing: 0.03em;
            color: #FFFFFF;
            width: 100%;
            height: 68.44px;
            padding-left: 8px;
            padding-right: 8px;
        }
        @media screen and (max-width:570px){
            #profile-dash-img{
                width: 78.5px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 15px;
            }
            #info-part{
                margin-left: 0px;
            }
        }
        @media screen and (min-width: 992px) {
            #info-part {
                margin-left: 55px;
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
                    <div class="d-flex">
                        <h3 class="fw-600">Zahidullah</h3><span class="iconify-inline" data-icon="emojione-monotone:hand-with-fingers-splayed" data-width="36" data-height="36"></span>
                    </div>
                    <div class="w-100 h-0 border border-gray m-0 p-0 horizontal-line"></div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column fw-800 mr-3">
                            <div>
                               Courses 
                            </div>
                            <div class="mx-auto">
                                5
                            </div>
                        </div>
                        <div class="d-flex flex-column fw-800 ml-3 justify-content-center">
                            <div>
                                Completed
                            </div>
                            <div class="mx-auto">
                                3
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex max-h-10 justify-content-center my-5">
                <div class="px-4 py-2 border my-auto fw-600" id="course-option">
                    Course
                </div>
                <div class="px-4 py-2 border my-auto fw-600" id="model-test-option">
                    Model Test
                </div>
            </div>
        </div>
        {{-- row-cols-md-3 row-cols-sm-1  --}}
        <div id="info-detail" class="row mx-auto my-5">
            <div id="info-left-option" class="d-flex flex-column justify-content-center my-3 col-md-3 mx-md-5 px-0">
                <div class="d-flex flex-column justify-content-center mx-auto border px-5 my-3" id="journey-cart">
                    <h5 class="fw-800 mx-auto">Amazing!</h5>
                    <span class="iconify-inline mx-auto" data-icon="openmoji:man-mountain-biking" data-width="36" data-height="36"></span>
                    <p class="fw-500 mx-auto" id="day-count">
                        You are on a 16 Day streak
                    </p>
                </div>
                <div class="" id="category-selection">
                    <div class="mx-auto mt-3 d-flex justify-content-between border py-2">
                        <div>
                            <h6 class="fw-500">Select Test Category</h6>
                        </div>
                        <div id="category-selection-icon">
                            <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                            <span class="iconify-inline d-none" data-icon="ic:baseline-greater-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                        </div>
                    </div>
                    {{-- category part --}}
                    <div class="mx-auto category-progress text-white">
                        <div class="category-name">
                           <div class="d-flex">
                            <h5 class="fw-600 pl-4">
                                Medical Admission
                               </h5>
                           </div>
                           <div class="progress">
                           </div>
                        </div>
                        <div class="category-link-icon">
                            <span class="iconify-inline" data-icon="ei:external-link" data-width="36" data-height="36" data-rotate="90deg" data-flip="horizontal"></span>
                        </div>
                    </div>
                    {{-- category part ends  --}}
                </div>
                {{-- subject selection part --}}
                <div class="" id="subject-selection">
                    <div class="mx-auto mt-3 d-flex justify-content-between border py-2">
                        <div>
                            <h6 class="fw-500">Choose Subject</h6>
                        </div>
                        <div id="subject-selection-icon">
                            <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                            <span class="iconify-inline d-none" data-icon="ic:baseline-greater-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                        </div>
                    </div>
                    <div class="mx-auto subjects text-white">
                           <div class="d-flex">
                                <h5 class="fw-600">Chemistry</h5>
                           </div>
                        <div>
                            <h5 class="fw-600">
                                45%
                            </h5>
                        </div>
                    </div>
                </div>
                {{-- subject selection part ends --}}
            </div>
            <div id="info-middle-option" class=" my-3 col-md-3 px-0">
                <div id="strength-title" class="strength-weakness-title-common">
                    <h2>Strength</h2>
                    <div>
                        <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>
                    </div>
                </div>
                <div class="p-3" id="strength-body">
                    <div class="strength-weakness-cq-mcq" id="">
                        hellow
                    </div>
                    <div class="w-100 h-0 border border-gray my-0 py-0 px-5" id="horizontal-line"></div>
                    <div class="strength-weakness-cq-mcq" id="">
                        hi
                    </div>
                </div>
            </div>
            <div id="info-right-option" class="my-3 col-md-3 mx-md-5 px-0">
                <div id="weakness-title" class="strength-weakness-title-common">
                    <h2>Weakness</h2>
                    <div>
                        <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>
                    </div>
                </div>
                <div class="p-3" id="weakness-body">
                    <div class="strength-weakness-cq-mcq" id="">

                    </div>
                    <div class="w-100 h-0 border border-gray m-0 p-0 horizontal-line" id=""></div>
                    <div class="strength-weakness-cq-mcq" id="">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/new-dashboard/iconify-icons.js"></script>
</x-landing-layout>
