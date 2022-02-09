<x-landing-layout headerBg="white">
   {{-- css linked --}}
   <link rel="stylesheet" href="/css/roadmap.css">
   {{-- css linked part ends  --}}
   <div class="d-flex flex-column position-relative pb-5" id="roadmapParentContainer">
      <div class="d-flex justify-content-around sticky-top" style="background: linear-gradient(90deg,#410169 0%,#280042 27%)">
         <div class="my-auto">
            <a href="{{route("home")}}" class="w-25"> <img src="/img/road_map/back.png" alt="getting back button" class="img-fluid w-25"></a>
         </div>
         <div class="my-auto d-flex justify-content-center pr-4">
            <h1 class="fw-800" id="roadmap-subject-topic-name">Physics</h1>
         </div>
      </div>
      <div class="d-flex justify-content-center container" id="ilandGrandParentContainer">
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
   {{-- script part --}}
   <script src="/js/roadmap.js">
   </script>
   {{-- script part ends  --}}
</x-landing-layout>
