@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/enterprise') }}" class="btn btn-primary">Enterprises</a>
            </div>
        </div>
    </div>
</div>
@if(session()->has('error'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger" role="alert">
                <h2>Error ...</h2>
            </div>
        </div>
    </div>
@endif

<!-- Mostrar todos los errores juntos -->
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<form role="form" action="{{ url('backend/enterprise') }}" method="post" id="createEnterpriseForm">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" maxlength="60" minlength="2" required class="form-control" id="name" placeholder="Enterprise name" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            
            <label for="phone">Phone</label>
            
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" maxlength="15" minlength="9" required class="form-control" id="phone" placeholder="Phone number" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="contactperson">Contact person</label>
            
            @error('contactperson')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" maxlength="100" minlength="2" required class="form-control" id="contactperson" placeholder="Contact person" name="contactperson" value="{{ old('contactperson') }}">
        </div>
        <div class="form-group">
            
            <label for="taxnumber">Tax Number</label>
            
            @error('taxnumber')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" maxlength="20" minlength="5" required class="form-control" id="taxnumber" placeholder="Tax number" name="taxnumber" value="{{ old('taxnumber') }}">
        </div>
        <div class="form-group">
            
            <label for="address">Address</label>
            
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <textarea required minlength="20" class="form-control" name="address" id="address" placeholder="Address" name="address">{{ old('address') }}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection