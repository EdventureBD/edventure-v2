<x-landing-layout headerBg="white">
   {{-- css linked --}}
   <link rel="stylesheet" href="/css/roadmap.css">
   {{-- css linked part ends  --}}
   <div class="my-5 p-5 d-flex flex-column" id="roadmapParentContainer">
      <div class="mx-auto">
         <h3 class="fw-700">Physics</h3>
      </div>
      <div class="d-flex w-25 position-relative">
      <a href="#" class="position-fixed" id="roadmap-backButton-div">
         <img src="/img/road_map/back.png" alt="" class="img-fluid w-25" id="roadmap-backButton-img">
      </a>
      </div>
      <div class="d-flex justify-content-center w-100">
         <div class="row row-cols-md-5 row-cols-sm-1 mx-5 px-md-5 px-sm-2 w-100 mt-0 pt-0" id="ilandsParentContainer">
            
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
