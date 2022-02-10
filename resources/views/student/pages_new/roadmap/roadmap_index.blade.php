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
         <div class="modal-content border-0" style="border-radius: 60px">
            <div class="modal-header border" style="border-radius: 60px 60px 0px 0px">
               <h5 class="modal-title mx-5 fw-800 text-black" id="exampleModalLabel">Road Map</h5>
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
