@extends('contacts.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>My contact list</h2>
            </div>
            <div class="pull-right">
                @auth
                <a class="btn btn-success" href="{{ route('contacts.create') }}"> Add Contact</a>
                @endauth
                <a class="btn btn-warning" href="{{ route('archived_contacts.list') }}"> Show Removed</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->phone }}</td>
            <td>
                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('contacts.show',$contact->id) }}">Show</a>
                    @auth
                    <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Edit</a>                    
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endauth
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $contacts->links() !!}
      
@endsection