@extends('admin.layouts.default', [
                                    'title'=>'Programs', 
                                    'pageName'=>'Create Program', 
                                    'secondPageName'=>'Create Program'
                                ])

@section('content')
    @livewire('intermediary-level.create', ['categories' => $categories])
@endsection