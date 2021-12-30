@extends('admin.layouts.default', [
                                    'title'=>'Intermediary Level', 
                                    'pageName'=>'Create Intermediary Level', 
                                    'secondPageName'=>'Create Intermediary Level'
                                ])

@section('content')
    @livewire('intermediary-level.create', ['categories' => $categories])
@endsection