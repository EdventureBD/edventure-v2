@extends('admin.layouts.default', [
                                    'title'=>'Course Lecture', 
                                    'pageName'=>'Edit Course Lecture', 
                                     'secondPageName'=>'Edit Course Lecture'
                                ])

@section('content')
    @livewire('course-lecture.edit', ['courseLecture' => $courseLecture])
@endsection