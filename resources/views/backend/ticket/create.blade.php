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
                <a href="{{ url('backend/ticket') }}" class="btn btn-primary">Tickets</a>
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
<form role="form" action="{{ url('backend/ticket') }}" method="post" id="createEnterpriseForm">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" maxlength="60" minlength="2" required class="form-control" id="name" placeholder="Enterprise name" name="name" value="{{ old('name') }}">
        </div>
        
        <div class="form-group">
            <label for="identerprise">Enterprise</label>
            
            @if(isset($enterprises))
            <select name="identerprise" id="identerprise" required class="form-control">
                <option value="" disabled selected>Select enterprise</option>
                @foreach($enterprises as $enterprise)
                
                <option value="{{ $enterprise->id }}">{{ $enterprise->name . ' ' . $enterprise->phone }}</option>
                
                @endforeach
            </select>
            @else
                <input type="text" value="{{ $enterprise->name . ' ' . $enterprise->phone }}" readonly class="form-control">
                <input type="hidden" id="identerprise" name="identerprise" value="{{ $enterprise->id }}">
            @endif
            
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" min="0.10" max="9999.99" step="0.01" required class="form-control" id="price" placeholder="Price" name="price" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="initialdate">Initial date</label>
            <input type="date" required class="form-control" id="initialdate" name="initialdate" value="{{ old('initialdate') }}">
        </div>
        <div class="form-group">
            <label for="finaldate">Final date</label>
            <input type="date" required class="form-control" id="finaldate" name="finaldate" value="{{ old('finaldate') }}">
        </div>
        <div class="form-group">
            <label for="initialtime">Initial time</label>
            <input type="time" required class="form-control" id="initialtime" name="initialtime" value="{{ old('initialtime') }}">
        </div>
        <div class="form-group">
            <label for="finaltime">Final time</label>
            <input type="time" required class="form-control" id="finaltime" name="finaltime" value="{{ old('finaltime') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea minlength="10" class="form-control" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection