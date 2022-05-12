<x-landing-layout headerBg="white">
   {{-- css linked --}}
   <link rel="stylesheet" href="{{ asset('/css/roadmap.css') }}">
   {{-- css linked part ends  --}}
   <div class="d-flex flex-column position-relative pb-5" id="roadmapParentContainer">
      <div class="d-flex fixed-top" id="roadmap-nav">
         <div class="my-auto pl-3">
            <a href="{{ $back_url }}"> <img src="/img/road_map/back.png" alt="getting back button" class="img-fluid" id="roadmap-back-btn"></a>
         </div>
         <div class="my-auto pr-5 mx-auto">
            <h1 class="fw-800" id="bundle-page-title">{{ $bundle->bundle_name }}</h1>
         </div>
      </div>

      <div style="" class="mt-5 mx-5">
         <div class="mt-5 mx-3">
            @foreach($errors->all() as $error)
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong> Error !</strong> {{ $error }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
            @endforeach
         </div>
      </div>

      <div class="row justify-content-center row-cols-md-5 row-cols-sm-1 mx-md-0 mt-lg-0 pt-lg-0 pt-sm-3 mt-sm-3" id="bundleParentContainer">

         @foreach ($bundle->courses as $key => $course)
            <a href="{{ route('batch-lecture', ['batch' => $course->Batch[0]->slug]) }}" style="color: white !important;">
               <div class="px-lg-5 px-sm-0 pb-5">
                  <div data-toggle="modal" data-target="#courseTopicModal-291">
                     <img src="{{ $course->island_image }}" alt="Iland image" class="img-fluid">
                  </div>
                  {{-- <h6 class="text-center pt-2 font-weight-bold">
                     {{ $course->title }}
                  </h6> --}}
               </div>
            </a>

            <div class="invisible">0</div>
         @endforeach
      </div>

</x-landing-layout>