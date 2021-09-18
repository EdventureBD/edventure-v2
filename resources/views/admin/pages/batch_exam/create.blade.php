@extends('admin.layouts.default', [
                                    'title'=>'Batch Exam', 
                                    'pageName'=>'Create Batch Exam', 
                                    'secondPageName'=>'Create Batch Exam'
                                ])

@section('content')
    @livewire('batch-exam.create')
@endsection