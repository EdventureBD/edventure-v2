<x-landing-layout headerBg="white">
   {{-- css linked --}}
   <link rel="stylesheet" href="/css/roadmap.css">
   {{-- css linked part ends  --}}
   <div class="d-flex flex-column position-relative pb-5" id="roadmapParentContainer">
      <div class="d-flex fixed-top" id="roadmap-nav">
         <div class="my-auto pl-3">
            <a href="{{route("home")}}"> <img src="/img/road_map/back.png" alt="getting back button" class="img-fluid" id="roadmap-back-btn"></a>
         </div>
         <div class="my-auto pr-5 mx-auto">
            <h1 class="fw-800" id="roadmap-subject-topic-name">Physics</h1>
         </div>
      </div>
      <div class="d-flex justify-content-center container mt-5 pt-4" id="ilandGrandParentContainer">
         <div class="row row-cols-md-5 row-cols-sm-1 mx-md-0 mt-lg-0 pt-lg-0 pt-sm-3 mt-sm-3" id="ilandsParentContainer">
            
         </div>
      </div>
   </div>

   {{-- Modal part --}}
   {{-- data-toggle="modal" data-target="#exampleModal" --}}
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header border">
               <h5 class="modal-title mx-auto fw-800 text-black" id="exampleModalLabel">Road Map</h5>
               </button>
            </div> 
            <div class="modal-body"> 
                <ul> 
                    <li>
                       <div class="w-25">
                           <img src="/img/road_map/rightSign.png" alt="" class=" px-md-4 px-sm-3 pt-md-2 img-fluid" id="model-test">
                       </div>
                       <a href="" class="fw-800 bg-info text-white d-flex justify-content-center rounded">Model Test</a>
                     </li>
                     <li>
                        <div class="w-25">
                           <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="aptitute-test">
                       </div>
                        <a href="" class="fw-800 bg-info text-white d-flex justify-content-center rounded">Aptitute Test</a>
                     </li>
                     <li>
                        <div class="w-25">
                           <img src="/img/road_map/wrongSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="mcq-test">
                       </div>
                        <a href="" class="fw-800 bg-info text-white d-flex justify-content-center rounded">MCQ Test</a>
                     </li>
                     <li>
                        <div class="w-25">
                           <img src="/img/road_map/rightSign.png" alt="" class="px-md-4 px-sm-3 pt-md-2 img-fluid" id="cq-test">
                       </div>
                        <a href="" class="fw-800 bg-info text-white d-flex justify-content-center rounded">CQ Test</a>
                     </li>
               </ul>
            </div>
            <div class="modal-footer mx-auto">
               <a class="close" data-dismiss="modal" aria-label="Close"> <img src="/img/road_map/back.png" alt="modal closing button" class="img-fluid" id="roadmap-modal-close-btn"></a>
            </div>
         </div>
      </div>
   </div>
   {{-- modal part ends  --}}
   {{-- script part --}}
   <script src="/js/roadmap.js">
   </script>
   {{-- script part ends  --}}
</x-landing-layout>
