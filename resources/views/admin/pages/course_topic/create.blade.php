@extends('admin.layouts.default', [
                                    'title'=>'Course Topic', 
                                    'pageName'=>'Create Course Topic', 
                                    'secondPageName'=>'Create Course Topic'
                                ])

@section('content')
    @livewire('course-topic.create')
@endsection