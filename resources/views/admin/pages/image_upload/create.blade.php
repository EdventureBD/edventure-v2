@extends('admin.layouts.default', [
                                    'title'=>'Upload Image', 
                                    'pageName'=>'Upload Image', 
                                    'secondPageName'=>'Upload Image'
                                ])

@section('content')
    @livewire('image-upload.create')
@endsection

@section('css1')
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('js1')
    <!-- Ekko Lightbox -->
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
@endsection

@section('js2')
    <!-- Filterizr-->
    <script src="{{ asset('admin/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endsection