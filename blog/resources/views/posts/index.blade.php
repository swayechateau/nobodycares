@extends('layouts.main')
@section('content')
    <h1>Posts in {{ app()->getLocale() }}</h1>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ url(app()->getLocale() . '/posts/' . $post) }}">{{ $post }}</a></li>
        @endforeach
    </ul>
@stop
