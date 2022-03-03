@extends('student.layouts.default', [
'title'=>'Payment',
'pageName'=>'Payment',
'secondPageName'=>'Payment'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        {{-- <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout"> --}}
        {{-- <div class="mdk-drawer-layout__content"> --}}
        <div class="page-section">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text"></div>
                </div>
                <div class="row card-group-row mb-lg-8pt">
                    <img src="{{ asset('student/public/images/jaconda-error-404.png') }}" alt=""
                        class="img-fluid mx-auto d-block mt-4">
                </div>
                <div class="page-separator">
                    <div class="page-separator__text"></div>
                </div>
            </div>
        </div>

        {{-- </div> --}}
        {{-- </div> --}}
    </div>
    <!-- // END Header Layout Content -->
@endsection
