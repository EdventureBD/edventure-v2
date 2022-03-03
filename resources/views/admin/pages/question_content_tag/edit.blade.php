@extends('admin.layouts.default', [
                                    'title'=>'Question Content Tag', 
                                    'pageName'=>'Edit Question Content Tag', 
                                    'secondPageName'=>'Edit Question Content Tag'
                                ])

@section('content')
    @livewire('question-content-tag.edit', [
        'questionContentTag' => $questionContentTag
    ])
@endsection