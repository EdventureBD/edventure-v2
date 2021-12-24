@extends('admin.layouts.default', [
                                    'title'=>'Course Category', 
                                    'pageName'=>'Create Course Category', 
                                    'secondPageName'=>'Create Course Category'
                                ])

@section('content')
    @livewire('course-category.create')
@endsection