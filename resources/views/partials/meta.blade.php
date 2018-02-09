<!doctype html>
<html lang="en">
<head>
	<title>@yield('meta_title', setting('site.title'))</title>
	<meta name="description" content="@yield('meta_description', setting('site.description')) - {{ setting('site.title') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Open Graph -->
	<meta property="og:site_name" content="{{ setting('site.title') }}" />
	<meta property="og:title" content="@yield('meta_title')" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ url('/') }}" />
	<meta property="og:image" content="@yield('meta_image', url('/') . '/apple-touch-icon.png')" />
	<meta property="og:description" content="@yield('meta_description', setting('site.description'))" />

	<!-- Icons -->
	<meta name="msapplication-TileImage" content="{{ url('/') }}/ms-tile-icon.png" />
	<meta name="msapplication-TileColor" content="#8cc641" />
	<link rel="shortcut icon" href="{{ url('/') }}/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="{{ url('/') }}/apple-touch-icon.png" />

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/app.css">
</head>
<body>