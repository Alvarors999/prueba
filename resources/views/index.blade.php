@extends('base')

@section('title')
Index Page
@endsection

@section('titlePart')
Hello world!
@endsection

@section('subtitle')
<h3>This is the second subtitle. h3</h3>
@parent
@endsection

@section('content')
<p>This is the new content. <a href="{{ url('ticket') }}">tickets</a></p>
<p>Escapar caracteres: {{ $cadena ?? '' }}</p>
<p>No escapar caracteres: {!! $cadena ?? '' !!}</p>

<p>No me llega: {{ $nomellega ?? 'No me ha llegado.' }}</p>

@auth
<h1>Eres un usuario autentificado</h1>
@endauth

@guest
<h1>Eres un usuario invitado</h1>
@endguest

@isset($nombre)
<h2>La variable $nombre tiene el valor {{ $nombre }}</h2>
@endisset

@if(isset($nombre))
<h2>La variable $nombre tiene el valor {{ $nombre }}</h2>
@endif


@endsection