<x-landing-layout headerBg="white">
    <div class="page-section">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text"></div>
            </div>
            <div class="row card-group-row mb-lg-8pt">
                <img src="{{ asset('img/landing/giphy.gif') }}" alt=""
                    class="img-fluid mx-auto d-block mt-4">
            </div>
            <div class="page-separator text-center">
                <a class="btn text-xxsm text-white bg-purple fw-800 px-2 py-2 w-20 mb-3 mt-4" href="{{ route('home') }}"></i> Go to home</a>
                <div class="page-separator__text"></div>
            </div>
        </div>
    </div>
</x-landing-layout>
