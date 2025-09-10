<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'E-Commerce' }}</title>
@include('frontend.include.css')
</head>
<body>
@include('frontend.include.header')





@yield('content')


@include('frontend.include.footer')


@include('frontend.include.js')
</body>
</html>