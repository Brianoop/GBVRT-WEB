@extends('dashboard.layouts.default')

@section('content')
    <div class="content-navigation-section">
        <h5>Activist Case Feedback</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    @if(Session::has('success'))
    <div class="alert alert-success">
        <span class="text text-success">{{ Session::get('success') }}</span>
    </div>
    @elseif (Session::has('error'))
        <div class="alert alert-success">
            <span class="text text-danger">{{ Session::get('error') }}</span>
        </div>
    @endif

    @isset($user_case)

        <div class="card shadow-sm p-3" style="font-size: .8em;">
            <div class="row">
                <div class="col-md-12">
                    <strong>Name</strong>
                    <p>{{ $activist->name }}</p>
                </div>

                <div class="col-md-12">
                    <strong>Email</strong>
                    <p>{{ $activist->email }}</p>
                </div>

                <div class="col-md-12">
                    <strong>Phone Number</strong>
                    <p>{{ $activist->contact }}</p>
                </div>        
                
            </div>
        </div>

    @endisset

    @foreach($feedback as $feed)

    <div class="alert alert-success my-3">
        <span> {{ $feed->created_at->diffForHumans() }}</span>
        <p>{{ $feed->feedback }}</p>
    </div>

    @endforeach

    {!! $feedback->links() !!}

@endsection
