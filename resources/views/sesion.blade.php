@extends('base')

@section('title')
Sesion
@endsection

@section('titlePart')
Sesion
@endsection

@section('content')
<h1>Sesion</h1>

<h2>{{ $incrementar }}</h2>

<h2>
    @if($suma != 0)
        {{ $suma }}
    @endif
</h2>

<h2>
    Flash: {{ Session::get('flash') }} {{ request()->session()->get('flash') }}
</h2>


<form action="{{ url('sesion') }}">
    <input type="number" name="incrementar" value=""/>
    <input type="submit" value="Submit"/>
</form>

@endsection