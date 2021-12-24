@extends('admin.layouts.default', [
                                    'title'=>'Exam', 
                                    'pageName'=>'Edit Exam', 
                                    'secondPageName'=>'Edit Exam'
                                ])

@section('content')
    @livewire('exam.edit', [
        'exam' => $exam
    ])
@endsection