@extends('admin.layouts.default', [
                                    'title'=>'Content Tag',
                                    'pageName'=>'Create Content Tag',
                                    'secondPageName'=>'Create Content Tag'
                                ])

@section('content')
    @livewire('content-tag.create')
@endsection