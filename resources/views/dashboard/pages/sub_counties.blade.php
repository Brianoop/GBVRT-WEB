@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Subcounties</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>
    <a href="{{ route('subcounty.create') }}">Create Subcounty</a>

    <table class="table">
        <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @if(count($sub_counties) > 0)

                @foreach($sub_counties as $sub_county)

                <tr>
                    <td> {{ $no++ }} </td>
                    <td>  {{ $sub_county->name }} </td>
                    <td>  {{ $sub_county->created_at->diffForHumans() }} </td>
                    <td>  {{ $sub_county->updated_at->diffForHumans() }} </td>
                    <td>
                        <a href="{{ url('/edit-sub-county' . '/'. $sub_county->id ) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>

                @endforeach

                {!! $sub_counties->links() !!}

            @endif 
        </tbody>
    </table>
   

@endsection
