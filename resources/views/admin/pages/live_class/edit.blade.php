@extends('admin.layouts.default', [
                                    'title'=>'Live Class', 
                                    'pageName'=>'Edit Live Class', 
                                    'secondPageName'=>'Edit Live Class'
                                ])

@section('content')
    @livewire('batch.edit', [
        'batch' => $batch
    ])
@endsection