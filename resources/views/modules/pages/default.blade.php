@php if (empty($layout)) $layout = 'default'; @endphp
@extends('voyager-frontend::layouts.' . $layout)
@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    @include('voyager-frontend::partials.breadcrumbs')

    {!! $page->body !!}
@endsection
