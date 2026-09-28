@props(['title' => ''])

@extends('layouts.producer', ['title' => $title])

@section('content')
    {{ $slot }}
@endsection
