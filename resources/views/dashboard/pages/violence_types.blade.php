@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Violence Types</h5>
        <a href="{{ url('/dashboard-home') }}" class="text text-primary">Back</a>
    </div>
    <a href="{{ route('violence.create') }}">Create Violence Type</a>
    @if(Session::has('success'))
        <br>
        <span class="text text-success">{{ Session::get('success') }}</span>
    @elseif (Session::has('error'))
        <br>
        <span class="text text-danger">{{ Session::get('error') }}</span>
    @endif

    <table class="table">
        <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @if(count($violence_types) > 0)

                @foreach($violence_types as $type)

                <tr>
                    <td> {{ $no++ }} </td>
                    <td>  {{ $type->name }} </td>
                    <td>  {{ $type->description }} </td>
                    <td>  {{ $type->created_at->diffForHumans() }} </td>
                    <td>  {{ $type->updated_at->diffForHumans() }} </td>
                    <td>
                        <a href="{{ url('/edit-violence-type' . '/'. $type->id ) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                    <td>
                        <a href="{{ url('/confirm-delete-violence-type' . '/' . $type->id ) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>

                @endforeach  

            @endif 
        </tbody>
       
    </table>

    {!! $violence_types->links() !!}
   

@endsection
