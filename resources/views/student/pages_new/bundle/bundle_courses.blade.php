<x-landing-layout headerBg="white">
   {{-- css linked --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

      <div class="row {{count($bundle->courses) == 1 ? 'justify-content-center' : 'justify-content-around' }} mx-md-0 mt-lg-0 pt-lg-0 pt-sm-3 mt-sm-3" id="bundleParentContainer">

         @foreach ($bundle->courses as $key => $course)
{{--             @php($href = $key == 0 ? route('batch-lecture', ['batch' => $course->Batch[0]->slug]) : 'Javascript:void(0)')--}}
{{--             @php($alert = $key == 0 ? '' : 'comingSoon')--}}
            <a href="{{route('batch-lecture', ['batch' => $course->Batch[0]->slug])}}" style="color: white !important;" class="col-lg-2 col-md-3 col-sm-12">
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
   </div>
</x-landing-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.comingSoon').on('click', function () {
        Swal.fire({
            icon: 'info',
            title: 'Coming Soon',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    })
</script>
