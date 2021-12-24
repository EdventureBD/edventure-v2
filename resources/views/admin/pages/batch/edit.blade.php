@extends('admin.layouts.default', [
                                    'title'=>'Batch', 
                                    'pageName'=>'Edit Batch', 
                                    'secondPageName'=>'Edit Batch'])

@section('content')
    @livewire('batch.edit', [
        'batch' => $batch
    ])
@endsection