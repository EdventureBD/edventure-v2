@extends('admin.layouts.default', [
    'title'=>'User',
    'pageName'=>'Create User',
    'secondPageName'=>'Create User'
])

@section('content')
    @livewire('user.create')
@endsection
