@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('backend/enterprise/create') }}" class="btn btn-primary">Create enterprise</a>
            </div>
        </div>
    </div>
</div>

<!--
op -> store, update, destroy
r -> negativo, 0, positivo (acierto)
id -> id del elemento afectado
-->

@if(session()->has('op'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Operation: {{ session()->get('op') }}. Id: {{ session()->get('id') }}. Result: {{ session()->get('r') }}
        </div>
    </div>
</div>
@endif

{{--
@if(Session::get('op') !== null)
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Enterprise created successfully 2: {{ Session::get('id') }}
        </div>
    </div>
</div>
@endif
--}}

<table class="table table-hover">
    <thead>
        <tr>
            <th>#id</th>
            <th>name</th>
            <th>phone</th>
            <th>contact person</th>
            <th>tax number</th>
            <th>add ticket</th>
            <th>view tickets</th>
            <th>show</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($enterprises as $enterprise)
        <tr>
            <td>{{ $enterprise->id }}</td>
            <td>{{ $enterprise->name }}</td>
            <td>
                {{ $enterprise->phone }}
                {{--
                @foreach($enterprise->tickets as $ticket)
                {{ $ticket->name }}
                @endforeach
                --}}
            </td>
            <td>{{ $enterprise->contactperson }}</td>
            <td>{{ $enterprise->taxnumber }}</td>
            
            <td><a href="{{ url('backend/ticket/create/' . $enterprise->id) }}">add</a></td>
            <td><a href="{{ url('backend/ticket/' . $enterprise->id . '/tickets') }}">view</a></td>
            
            <td><a href="{{ url('backend/enterprise/' . $enterprise->id) }}">show</a></td>
            <td><a href="{{ url('backend/enterprise/' . $enterprise->id . '/edit') }}">edit</a></td>
            <td><a href="#" data-id="{{ $enterprise->id }}" class="enlaceBorrar" >delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/enterprise') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection