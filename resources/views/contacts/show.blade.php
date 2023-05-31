@extends('contacts.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Contact Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $contact->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $contact->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                {{ $contact->phone }}
            </div>
        </div>
    </div>

    @auth
    <div class="row">
        <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
            <div class="pull-left">
                <a class="btn btn-warning" href="{{ route('contacts.edit', $contact->id) }}"> Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>        
    </div>
    @endauth
@endsection