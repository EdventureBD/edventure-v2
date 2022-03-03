@extends('admin.layouts.default', [
                                    'title'=>'Content Tag', 
                                    'pageName'=>'Edit Content Tag', 
                                    'secondPageName'=>'Edit Content Tag'
                                ])

@section('content')
    @livewire('content-tag.edit', [
        'contentTag' => $contentTag
    ])
@endsection