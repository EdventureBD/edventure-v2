@extends('admin.layouts.default', [
                                    'title'=>'Batch', 
                                    'pageName'=>'Edit Batch Lecture', 
                                    'secondPageName'=>'Edit Batch Lecture'
                                ])

@section('content')
    @livewire('batch.edit', [
        'batch' => $batch
    ])
@endsection