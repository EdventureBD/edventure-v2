@extends('admin.layouts.default', [
                                    'title'=>'Course', 
                                    'pageName'=>'Edit Course', 
                                    'secondPageName'=>'Edit Course'
                                ])

@section('content')
    @livewire('course.edit', ['course' => $course])
@endsection