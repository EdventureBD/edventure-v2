
   <x-landing-layout headerBg="white">
      {{-- custom css linked --}}
      <link rel="stylesheet" href="{{ asset('/css/new-dashboard.css') }}">
      {{-- custom css linked --}}

      <div id="parent-div" class="mt-5 pt-5 p-5">
         <div id="info-part" class="d-md-flex justify-content-between align-items-middle">
            <div class="d-md-flex justify-content-start mr-auto">
                  <div class="d-md-flex" id="profile-dash-img">
                     <img src="https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_3.jpg" alt="profile-photo" class="img-fluid" style="border-radius: 50%">
                  </div>
                  <div class="d-flex flex-column justify-content-center align-top ml-3">
                     <div class="d-flex">
                        <h3 class="fw-600">{{ $user->name }}</h3><span class="iconify-inline" data-icon="emojione-monotone:hand-with-fingers-splayed" data-width="36" data-height="36"></span>
                     </div>
                     <div class="w-100 h-0 border border-gray m-0 p-0 horizontal-line"></div>
                     @if(request()->is('profile'))
                        <div class="d-flex justify-content-between">
                           <div class="d-flex flex-column fw-800 mr-3">
                                 <div>
                                    Courses
                                 </div>
                                 <div class="mx-auto">
                                    {{ $enrolled_course_count }}
                                 </div>
                           </div>
                           <div class="d-flex flex-column fw-800 ml-3 justify-content-center">
                                 <div>
                                    Completed
                                 </div>
                                 <div class="mx-auto">
                                    {{ $completed_course_count }}
                                 </div>
                           </div>
                        </div>
                     @endif
               </div>
            </div>
            <div class="d-flex max-h-10 justify-content-center my-5">
                <a href="{{route('profile')}}" class="text-decoration-none">
                    <div style="{{request()->is('profile') ? 'background: #FA9632 ; color: white;' : 'background: white ; color: black;'}}"
                         class="px-4 py-2 border my-auto fw-600" id="course-option">
                        Course
                    </div>
                </a>
                <a href="{{route('profile.modelTest')}}" class="text-decoration-none">
                    <div style="{{request()->is('profile/model-test') ? 'background: #FA9632 ; color: white;' : 'background: white ; color: black;'}}"
                         class="px-4 py-2 border my-auto fw-600" id="model-test-option">
                        Model Test
                    </div>
                </a>


            </div>
         </div>
            @yield('content')
      </div>
   </x-landing-layout>
