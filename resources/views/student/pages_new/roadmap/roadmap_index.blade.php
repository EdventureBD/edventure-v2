<x-landing-layout headerBg="white">
<div class="page-section ">
      <div class="mx-md-5">
         <div class="">
            <div class=" text-center bradius-10 w-100 text-gray text-sm fw-700"> Roadmap </div>
         </div>
         {{-- d-flex justify-content-center all-blog py-3 card-group-row mb-lg-8pt --}}
         <div class="d-flex justify-content-center all-blog py-3 card-group-row  mb-lg-8pt">
            <div id="roadmapParentContainer">
                  <div id="leftIlands" class="d-grid grid-cols-1">
                     <div class="single-leftIland-container mb-5 pb-5">
                        <div class="iland_image">
                           <a href="#" data-toggle="modal" data-target="#exampleModal">
                              <img src="/img/road_map/landl1.png" alt="" class=" img-fluid">
                           </a>
                        </div>
                        <div class="iland_stars d-flex">

                        </div>
                     </div>
                     {{-- second iland  --}}
                     <div class="single-leftIland-container mb-5 pb-5">
                        <div class="iland_image">
                           <a href="#" data-toggle="modal" data-target="#exampleModal">
                              <img src="/img/road_map/landl1.png" alt="" class=" img-fluid">
                           </a>
                        </div>
                        <div class="iland_stars d-flex">

                        </div>
                     </div>
                     {{-- second iland ends  --}}
                     {{-- third iland  --}}
                     <div class="single-leftIland-container mb-5 pb-5">
                        <div class="iland_image">
                           <a href="#" data-toggle="modal" data-target="#exampleModal">
                              <img src="/img/road_map/landl1.png" alt="" class=" img-fluid">
                           </a>
                        </div>
                        <div class="iland_stars d-flex">

                        </div>
                     </div>
                     {{-- third iland ends --}}
                  </div>
                  {{-- arrow part  --}}
                  <div id="arrows" class="d-grid grid-cols-1">
                     <div class="my-2">
                        <div class="arrow_img">
                           <img src="/img/road_map/arrowR2L.png" alt="" class=" img-fluid">
                        </div>
                     </div>
                     {{-- second arrow part --}}
                     <div class="my-2">
                        <div class="arrow_img">
                           <img src="/img/road_map/arrowL2R.png" alt="" class=" img-fluid">
                        </div>
                     </div>
                     {{-- second arrow part ends  --}}
                     {{-- third arrow part --}}
                     <div class="my-2">
                        <div class="arrow_img">
                           <img src="/img/road_map/arrowR2L.png" alt="" class=" img-fluid">
                        </div>
                     </div>
                     {{-- third arrow part ends --}}
                     {{-- forth arrow part --}}
                     <div class="my-2">
                        <div class="arrow_img">
                           <img src="/img/road_map/arrowL2R.png" alt="" class=" img-fluid">
                        </div>
                     </div>
                     {{-- fourth arrow part ends --}}
                     {{-- fifth arrow part --}}
                     <div class="my-2">
                        <div class="arrow_img">
                           <img src="/img/road_map/arrowR2L.png" alt="" class=" img-fluid">
                        </div>
                     </div>
                     {{-- fifth arrow part ends --}}

                  </div>
                  {{-- arrow part ends  --}}
                  {{-- right ilands  --}}
                  <div id="rightIlands" class="d-grid grid-cols-1 gap-y-10 mt-5">
                     <div class="single-right-iland my-3 py-5">
                        <div class="iland_image">
                           <a href="#" data-toggle="modal" data-target="#exampleModal">
                              <img src="/img/road_map/landr1.png" alt="" class=" img-fluid">
                           </a>
                        </div>
                        <div class="iland_stars d-flex">

                        </div>
                     </div>
                     {{-- second right ilands  --}}
                     <div class="single-right-iland my-3 py-5">
                        <div class="iland_image">
                           <a href="#" data-toggle="modal" data-target="#exampleModal">
                              <img src="/img/road_map/landr1.png" alt="" class=" img-fluid">
                           </a>
                        </div>
                        <div class="iland_stars d-flex">

                        </div>
                     </div>
                     {{-- second right ilands ends --}}
                     {{-- third right ilands  --}}
                     <div class="single-right-iland my-3 py-5">
                        <div class="iland_image">
                           <a href="#" data-toggle="modal" data-target="#exampleModal">
                              <img src="/img/road_map/landr1.png" alt="" class=" img-fluid">
                           </a>
                        </div>
                        <div class="iland_stars d-flex">

                        </div>
                     </div>
                     {{-- third right ilands ends --}}
                  </div>
                  {{-- right ilands part ends  --}}
            </div>
         </div>
         {{-- Modal part --}}
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <ul>
                     <li><a href="">Model Test</a></li>
                     <li><a href="">Aptitute Test</a></li>
                     <li><a href="">MCQ Test</a></li>
                     <li><a href="">CQ Test</a></li>
                  </ul>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
               </div>
            </div>
            </div>
         </div>
         {{-- modal part ends  --}}
      </div>
</div>
</x-landing-layout>
