@extends('admin.layouts.default', [
                                    'title'=>'Course', 
                                    'pageName'=>'Create Course', 
                                    'secondPageName'=>'Create Course'
                                ])

@section('content')
    @livewire('course.create', ['intermediary_levels' => $intermediary_levels])
@endsection