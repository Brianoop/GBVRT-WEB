@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Account</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">

         @if(Auth()->user()->type == 1)
            <a href="{{ route('user.create') }}" class="btn btn-info btn-sm">Create New Account</a> <a href="{{ route('user.accounts') }}" class="btn btn-info btn-sm">View Accounts</a> 
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

            <label for="Contact" class="mb-1">Contact</label>
            <strong>{{ Auth()->user()->contact != null ? Auth()->user()->contact : 'Not Available' }}</strong>

            <br>

            <label for="Avatar" class="mb-1">Avatar</label>
            @if(Auth()->user()->avatar != null)

                <img src="{{ asset(Auth()->user()->avatar) }}" alt="Avatar" width="150" height="170">

            @else 
                <strong>Not Available</strong>
            @endif

            <br>

            <label for="Role" class="mb-1">Role</label>
            <strong>
                @if(Auth()->user()->type == 1) Administrator @endif
                @if(Auth()->user()->type == 2) Activist @endif
                @if(Auth()->user()->type == 3) User @endif
            </strong>

            <br>
            <a href="{{ url('/edit-user-account' . '/' . Auth()->user()->id ) }}" class="btn btn-warning btn-sm">Edit Account</a>

        </div>
    </div>

@endsection