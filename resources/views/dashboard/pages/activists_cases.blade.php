@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Activist Cases</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">
        <div class="row">

            @isset($user_cases)
                @if (count($user_cases) > 0)
                    @foreach ($user_cases as $case)
                        <div class="card shadow mb-4 mr-5 ml-5 pt-3 pb-3 pr-1 pl-1">
    
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
    
    
    
                            <div>
                                <strong>Description</strong>
                                <p>
                                    {{ $case->users_case_details }}
                                </p>
                            </div>

                            <a href="{{ url('/activist-view-case_detail' . '/' . $case->case_id ) }}" class="btn btn-success">Give Feedback</a>
    
                        </div>
                    @endforeach
                @else
                    <strong>There are no cases for you to view!</strong>
                @endif
            @endisset
        </div>
    </div>
 @endsection
