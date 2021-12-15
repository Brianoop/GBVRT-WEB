@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Activist Cases</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="row">
       
     @isset($user_cases)
        
        @if(count($user_cases) > 0)

            @foreach($user_cases as $case)

                <div class="card shadow mb-4">

                    <div class="row mt-1 mb-1">
                        <div class="col-md-3">
                          <strong>Name</strong>  
                        </div>
                        <div class="col-md-6">
                            {{ $case->name }}
                        </div>
                    </div>

                    <div class="row mt-1 mb-1">
                        <div class="col-md-3">
                          <strong>Contact</strong>  
                        </div>
                        <div class="col-md-6">
                            {{ $case->contact }}
                        </div>
                    </div>

                    <div class="row mt-1 mb-1">
                        <div class="col-md-3">
                          <strong>Email</strong>  
                        </div>
                        <div class="col-md-6">
                            {{ $case->email }}
                        </div>
                    </div>

                    <div class="row mt-1 mb-1">
                        <div class="col-md-3">
                          <strong>Sub County</strong>  
                        </div>
                        <div class="col-md-6">
                            {{ $case->sub_county_name }}
                        </div>
                    </div>

                    <div class="row mt-1 mb-1">
                        <div class="col-md-3">
                          <strong>Violence</strong>  
                        </div>
                        <div class="col-md-6">
                            {{ $case->violence_name }}
                        </div>
                    </div>

                    <div>
                        <strong>Description</strong>
                        <p>
                            {{ $case->users_case_details }}
                        </p>
                    </div>

                </div>

            @endforeach

        @else 
            <strong>There are no cases for you to view!</strong>
        @endif

     @endisset

@endsection