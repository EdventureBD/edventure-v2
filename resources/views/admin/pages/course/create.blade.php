@extends('admin.layouts.default', [
                                    'title'=>'Course', 
                                    'pageName'=>'Create Course', 
                                    'secondPageName'=>'Create Course'
                                ])

@section('content')
    @livewire('course.create', ['categories' => $categories])
@endsection