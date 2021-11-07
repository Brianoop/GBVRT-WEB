@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Case Detail</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="card shadow-sm p-3">
        <div class="row">
            <div class="col-md-12">
                <strong>Case ID</strong>
                <p>{{ $user_case->case_id }}</p>
            </div>

            <div class="col-md-12">
                <strong>Sub County</strong>
                <p>{{ $user_case->sub_county }}</p>
            </div>
            
            <div class="col-md-12">
                <strong>Details</strong>
                <p>{{ $user_case->case_details }}</p>
            </div>
            <div class="col-md-12">
                <strong>Violence Name</strong>
                <p>{{ $user_case->violence_name }}</p>
            </div>
            <div class="col-md-12">
                <strong>Violence Description</strong>
                <p>{{ $user_case->violence_description }}</p>
            </div>
            <div class="col-md-12">
                <a  value="{{ $user_case->case_id }}" class="btn btn-sm btn-outline-danger" href="{{ url('/confirm-delete-case' . '/' . $user_case->case_id ) }}"><i class="fa fa-trash fa-sm"></i> Delete</a>
                {{-- <button id="deleteCaseBtn" value="{{ $user_case->case_id }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-sm"></i> Delete</button> --}}
            </div>
        </div>
    </div>



@endsection
