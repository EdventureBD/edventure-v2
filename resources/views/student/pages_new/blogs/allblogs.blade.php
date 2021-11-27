<x-landing-layout headerBg="white">
    <div class="page-section ">
        <div class="container ">
            <div class="py-4">
                <div class=" text-center bradius-10 w-100 text-gray text-sm fw-700"> All Blogs</div>
            </div>
            <div class="py-2 py-md-1 text-center d-flex justify-content-center">
               <p class="text-center">{{ $blogs->links('vendor.pagination.custom') }}</p> 
            </div>
            <div class="row justify-content-center all-blog py-3 card-group-row mb-lg-8pt">
                @foreach ($blogs as $blog)
                <div class="col-md-3">
                <div class=" mb-4 single-blog overlay  bradius-10">
                    <img src="{{asset($blog->banner)}}" class="blog-banner bradius-10 img-fluid" alt="">
                    <div class="blog-info text-right p-3 w-100">
                        <a href="{{ route('read-blog', $blog->slug) }}"> <h3 class="text-xxsm text-white">{{ $blog->title }}</h3></a>
                            <a href="{{ route('read-blog', $blog->slug) }}"> <h4 class="text-xxxsm text-white">{{ $blog->subtitle }}</h2></a>
                        <div class="blog-author d-inline-block">
                            <img src="{{ $blog->author->image }}" class="rounded-circle img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            </div>
        </div>
    </div>
</x-landing-layout>
