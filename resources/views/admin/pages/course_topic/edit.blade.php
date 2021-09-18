@extends('admin.layouts.default', [
                                    'title'=>'Course Topic', 
                                    'pageName'=>'Edit Course topic', 
                                    'secondPageName'=>'Edit Course topic'
                                ])

@section('content')
    @livewire('course-topic.edit', ['course_topic' => $course_topic])
@endsection