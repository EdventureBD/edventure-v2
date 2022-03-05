<x-landing-layout headerBg="white">
   <!-- Header Layout Content -->
   <div class="page-section container py-6">
      <div class="row justify-content-center">
         <div class="col-lg-8">
            <h2 class="text-sm text-center">Bundle : <b>{{$bundle->bundle_name}}</b></h2>
            @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                  </ul>
               </div>
            @endif
                  
         </div>
      </div>
      
   </div>
</x-landing-layout>
