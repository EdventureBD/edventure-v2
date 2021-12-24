
<x-landing-layout metatag="{{$meta_tag}}" metadesc="{{$meta_description}}" >

    <section class="page-section header-banner pt-7">
        <div class="container">
            <div class="pl-3">
                <h3 class="text-purple text-sm fw-600 ">{!!$title!!}</h3>
                <p class="fw-600 text-xsm text-purple-half">{!!$subtitle!!}
                </p>
            </div>
            <div class="text-center blog-banner" >
                <img src="{{$banner}}" class="img-fluid" alt="">
            </div>
            <div class="mt-3 container description">
                <p>
                    {!! $description !!}
                </p>
            </div>

            <div class="mt-3">
                <div class="text-center blog-single-author">
                    @if(!empty($author_image))
                        <img src="{{$author_image}}" class="text-center d-inline-block img-fluid" alt="">
                    @else
                        <img src="/img/landing/subscribe_user.png" class="text-center d-inline-block img-fluid" alt="">
                    @endif
                </div>
                <p class="text-purple text-xxsm fw-600 text-center mt-2 mb-0">AUTHOR</p>
                <p class="text-purple text-xsm fw-600 text-center">{{$author_name}}</p>

            </div>
            {{-- <div class="fb-comments" data-href="{{Request::url()}}" data-width="" data-numposts="1000"></div> --}}
            <div class="text-center">
                <div class="fb-comments" lazy="true" data-href="{{Request::url()}}" data-width="" data-numposts="5"></div>   
            </div>     
        </div>

    
</x-landing-layout>


