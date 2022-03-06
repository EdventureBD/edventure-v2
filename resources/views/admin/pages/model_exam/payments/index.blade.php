@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Payments',
'secondPageName' => 'Payments'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @yield('content')

@endsection
@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
