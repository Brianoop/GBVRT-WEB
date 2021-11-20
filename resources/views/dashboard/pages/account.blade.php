@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Account</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">

         @if(Auth()->user()->type == 1)
            <a href="{{ route('user.create') }}" class="btn btn-info btn-sm">Create New Account</a> 
         @endif

        <br> <br>

        <div class="card p-4">
            <h6>My Account</h6>

            <label for="Name" class="mb-1">Name</label>
            <strong>{{ Auth()->user()->name }}</strong>

            <br>

            <label for="Email" class="mb-1">Email</label>
            <strong>{{ Auth()->user()->email }}</strong>

            <br>

            <label for="Role" class="mb-1">Role</label>
            <strong>
                @if(Auth()->user()->type == 1) Administrator @endif
                @if(Auth()->user()->type == 2) Activist @endif
                @if(Auth()->user()->type == 3) User @endif
            </strong>

        </div>
    </div>

@endsection