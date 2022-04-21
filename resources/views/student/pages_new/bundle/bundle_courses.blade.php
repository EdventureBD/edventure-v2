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
            <h1 class="fw-800" id="roadmap-subject-topic-name">{{ $bundle->bundle_name }}</h1>
         </div>
      </div>

      <div style="" class="mt-5 mx-5">
         <div class="mt-5 mx-3">
            @error('not_added_to_batch')
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong> Error !</strong> {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
            @enderror
         </div>
      </div>

      <div class="row row-cols-md-5 row-cols-sm-1 mx-md-0 mt-lg-0 pt-lg-0 pt-sm-3 mt-sm-3" id="ilandsParentContainer">

         @forelse ($bundle->courses as $key => $course)
            <a href="{{ route('batch-lecture', ['batch' => $course->Batch[0]->slug]) }}" style="color: white !important;">
               <div class="px-lg-5 px-sm-0 pb-5">
                  <div data-toggle="modal" data-target="#courseTopicModal-291"><img src="{{ $course->island_image }}" alt="Iland image" class="img-fluid"></div>
                  <h6 class="text-center pt-2 font-weight-bold">
                     {{ $course->title }}
                  </h6>
               </div>
            </a>

            <div class="invisible">0</div>

         @empty
            <div>
               <h1 class="mx-auto text-center">No Course Added To This Bundle !! Please Contact System Admin.</h1>
            </div>
         @endforelse
      </div>

</x-landing-layout>