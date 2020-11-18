@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/enterprise/' . $enterprise->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/enterprise') }}" class="btn btn-primary">Enterprises</a>
                <a href="#" data-id="{{ $enterprise->id }}" data-name="{{ $enterprise->name }}" class="btn btn-danger" id="enlaceBorrar">Delete enterprise</a>
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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form role="form" action="{{ url('backend/enterprise/' . $enterprise->id) }}" method="post" id="editEnterpriseForm" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" maxlength="60" minlength="2" required class="form-control" id="name" placeholder="Enterprise name" name="name" value="{{ old('name', $enterprise->name) }}">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" maxlength="15" minlength="9" required class="form-control" id="phone" placeholder="Phone number" name="phone" value="{{ old('phone', $enterprise->phone) }}">
        </div>
        <div class="form-group">
            <label for="contactperson">Contact person</label>
            <input type="text" maxlength="100" minlength="2" required class="form-control" id="contactperson" placeholder="Contact person" name="contactperson" value="{{ old('contactperson', $enterprise->contactperson) }}">
        </div>
        <div class="form-group">
            <label for="taxnumber">Tax Number</label>
            <input type="text" maxlength="20" minlength="5" required class="form-control" id="taxnumber" placeholder="Tax number" name="taxnumber" value="{{ old('taxnumber', $enterprise->taxnumber) }}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea required minlength="20" class="form-control" name="address" id="address" placeholder="Address" name="address">{{ old('address', $enterprise->address) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo">
        </div>
        
        <div class="form-group">
            <label for="privada">Privada</label>
            <input type="file" class="form-control" id="privada" name="privada">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection