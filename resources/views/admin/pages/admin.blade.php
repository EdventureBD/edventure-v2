@extends('admin.layouts.default', [
'title'=>'Dashboard',
'pageName'=>'Dashboard',
'secondPageName'=>'dashboard'
])

@section('content')
    <h2>Welcome to Dashboard</h2>
    <img src="{{ asset('admin/image/dashboard.gif') }}" alt="" class="img-fluid  mx-auto d-block ">
@endsection
