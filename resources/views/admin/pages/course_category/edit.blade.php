@extends('admin.layouts.default', [
                                    'title'=>'Course Category', 
                                    'pageName'=>'Edit Course Category', 
                                    'secondPageName'=>'Edit Course Category'
                                ])

@section('content')
    @livewire('course-category.edit', ['category' => $courseCategory])
@endsection