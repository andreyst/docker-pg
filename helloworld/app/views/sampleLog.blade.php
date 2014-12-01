@extends('layout')

<h1>This is our sample log</h1>
@section('content')
    @foreach($sampleLog as $logEntry)
        <p>{{ $logEntry->message }}</p>
    @endforeach
@stop
