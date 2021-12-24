@extends('admin.layouts.default', [
                                    'title'=>'Batch Lectures', 
                                    'pageName'=>'Add Batch Lectures', 
                                    'secondPageName'=>'Add Batch Lectures'
                                ])

@section('content')
    @livewire('batch-lecture.create')
@endsection