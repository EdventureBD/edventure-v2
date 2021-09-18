@extends('admin.layouts.default', [
                                    'title'=>'Course Category', 
                                    'pageName'=>'Create Course Lecture', 
                                    'secondPageName'=>'Create Course Lecture'
                                ])

@section('content')
    @livewire('course-lecture.create')
@endsection