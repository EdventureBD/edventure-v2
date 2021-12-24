@extends('admin.layouts.default', [
                                    'title'=>'Exam', 
                                    'pageName'=>'Create Exam', 
                                    'secondPageName'=>'Create Exam'
                                ])

@section('content')
    @livewire('exam.create')
@endsection