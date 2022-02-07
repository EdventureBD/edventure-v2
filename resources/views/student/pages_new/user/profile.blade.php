<x-landing-layout headerBg="white">
    {{-- custom css linked --}}
    <link rel="stylesheet" href="/css/new-dashboard.css">
    {{-- custom css linked --}}

    <div id="parent-div" class="mt-5 pt-5 p-5">
        <div id="info-part" class="d-md-flex justify-content-between align-items-middle">
            <div class="d-md-flex justify-content-start mr-auto">
                <div class="d-md-flex" id="profile-dash-img">
                    <img src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_3.jpg" alt="profile-photo" class="img-fluid" style="border-radius: 50%">
                </div>
                <div class="d-flex flex-column justify-content-center align-top ml-3">
                    <div class="d-flex">
                        <h3 class="fw-600">Zarin</h3><span class="iconify-inline" data-icon="emojione-monotone:hand-with-fingers-splayed" data-width="36" data-height="36"></span>
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
                    <div class="mx-auto mt-3 d-flex justify-content-between border py-2" type="button" data-toggle="collapse" data-target="#categories" aria-expanded="false" aria-controls="collapseExample">
                        <div>
                            <h6 class="fw-500" id="category-selection-text">Select Test Category</h6>
                        </div>
                        <div id="category-selection-icon">
                            <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                            {{-- <span class="iconify-inline d-none" data-icon="ic:baseline-greater-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span> --}}
                        </div>
                    </div>
                    {{-- category part --}}
                    <div class="mx-auto category-progress collapse text-white" id="categories">
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
                    <div class="mx-auto mt-3 d-flex justify-content-between border py-2" type="button" data-toggle="collapse" data-target="#subjectschoicing" aria-expanded="false" aria-controls="collapseExample">
                        <div>
                            <h6 class="fw-500" id="subject-selection-text">Choose Subject</h6>
                        </div>
                        <div id="subject-selection-icon">
                            <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                            {{-- <span class="iconify-inline d-none" data-icon="ic:baseline-greater-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span> --}}
                        </div>
                    </div>
                    <div class="mx-auto subjects collapse text-white" id="subjectschoicing">
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
                       <div>
                            <h5 class="fw-600">MCQ</h5>
                       </div>
                       <div class=" text-black">
                           <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Newton D Costa</p>
                           <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Newton D Generio la</p>
                           <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Newton</p>
                           <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Newton</p>
                           <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Newton</p>
                           <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Newton</p>
                       </div>
                       <div>
                           <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                               See More
                           </a>
                       </div>
                    </div>
                    <div class="w-100 h-0 border border-gray my-3 py-0 px-5" id="horizontal-line"></div>
                    <div class="strength-weakness-cq-mcq" id="">
                        <div>
                            <h5 class="fw-600">CQ</h5>
                       </div>
                       <div class=" text-black">
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p>
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
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
                        <h5 class="fw-600">MCQ</h5>
                     </div>
                     <div class="text-black">
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p>
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                     <div class="w-100 h-0 border border-gray my-3 py-0 px-5" id="horizontal-line"></div>
                     <div class="strength-weakness-cq-mcq" id="">
                         <h5 class="fw-600">CQ</h5>
                     </div>
                     <div class="text-black">
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p>
                        <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p>
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div>
                <span class="iconify mr-5" data-icon="fa-solid:angle-left"></span>
            </div>
           <div>
                <span class="iconify ml-5" data-icon="fa-solid:angle-right"></span>
           </div>
        </div>
    </div>
    {{-- icon's script part linked --}}
    <script src="/js/new-dashboard/iconify-icons.js"></script>
    {{-- icon's script part linked --}}

    {{-- frontend script part --}}
    <script>
         const courseButtonAction = () => {
            categorySelectionText.innerText = "Select Course";
            subjectSelectionText.innerText = "Choose Subject";
            courseOption.setAttribute("style", "background: #FA9632 ; color: white;");
            modelTestOption.setAttribute("style", "background: white ; color: black;");
        }
         const modelTestButtonAction = () => {
            categorySelectionText.innerText = "Select Test Category";
            subjectSelectionText.innerText = "Choose Subject";
            modelTestOption.setAttribute("style", "background: #FA9632 ; color: white;");
            courseOption.setAttribute("style", "background: white ; color: black;");
        }
        let categorySelectionText = document.getElementById("category-selection-text");
        let subjectSelectionText = document.getElementById("subject-selection-text");
        let courseOption = document.getElementById("course-option");
        courseOption.addEventListener("click",courseButtonAction);

        let modelTestOption = document.getElementById("model-test-option");
        modelTestOption.addEventListener("click",modelTestButtonAction);

       
    </script>
    {{-- frontend script part ends --}}
</x-landing-layout>
