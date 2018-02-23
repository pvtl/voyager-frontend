@extends('voyager-frontend::layouts.default')
@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    {!! $page->body !!}
@endsection
