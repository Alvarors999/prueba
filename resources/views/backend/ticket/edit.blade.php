@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')

<form id="formDelete" action="{{ url('backend/ticket/' . $ticket->id) }}" method="post">
    @method('delete')
    @csrf
</form>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/ticket') }}" class="btn btn-primary">Tickets</a>
                <a href="#" data-id="{{ $ticket->id }}" data-name="{{ $ticket->name }}" class="btn btn-danger" id="enlaceBorrar">Delete ticket</a>
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
<form role="form" action="{{ url('backend/ticket/' . $ticket->id) }}" method="post" id="editTicketForm">
    @csrf
    @method('put')
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" maxlength="60" minlength="2" required class="form-control" id="name" placeholder="Enterprise name" name="name" value="{{ old('name, $ticket->name') }}">
        </div>
        
        <div class="form-group">
            <label for="identerprise">Enterprise</label>
            <select name="identerprise" id="identerprise" required class="form-control">
                <option value="" disabled>Select enterprise</option>
                @foreach($enterprises as $enterprise)
                
                @if($enterprise->id == old('identerprise', $ticket->identerprise))
                
                <option selected value="{{ $enterprise->id }}">{{ $enterprise->name . ' - ' . $enterprise->phone }}</option>
                @else
                    <option value="{{ $enterprise->id }}">{{ $enterprise->name . ' - ' . $enterprise->phone }}</option>
                @endif
                
                @endforeach
            </select>
            
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" min="0.10" max="9999.99" step="0.01" required class="form-control" id="price" placeholder="Price" name="price" value="{{ old('price, $ticket->price') }}">
        </div>
        <div class="form-group">
            <label for="initialdate">Initial date</label>
            <input type="date" required class="form-control" id="initialdate" name="initialdate" value="{{ old('initialdate, $ticket->initialdate') }}">
        </div>
        <div class="form-group">
            <label for="finaldate">Final date</label>
            <input type="date" required class="form-control" id="finaldate" name="finaldate" value="{{ old('finaldate, $ticket->finaldate') }}">
        </div>
        <div class="form-group">
            <label for="initialtime">Initial time</label>
            <input type="time" required class="form-control" id="initialtime" name="initialtime" value="{{ old('initialtime, $ticket->initialtime') }}">
        </div>
        <div class="form-group">
            <label for="finaltime">Final time</label>
            <input type="time" required class="form-control" id="finaltime" name="finaltime" value="{{ old('finaltime, $ticket->finaltime') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea minlength="10" class="form-control" name="description" id="description" placeholder="Description">{{ old('description', $ticket->description) }}</textarea>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection