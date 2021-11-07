@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>My Complaints</h5>
        <a href="{{ url('/send-complaint') }}" class="text text-primary">Back</a>
    </div>

    @if(Session::has('status'))

    <div class="{{ Session::get('status') == true ? 'alert alert-success' : 'alert alert-danger'}}">
        {{ Session::get('message') }}
    </div>

    @endif

    @forelse($users_complaints as $user_complaint)
        <div class="card shadow-sm p-3">
            <p class="text text-sm"><i>{{ $user_complaint->content }}</i></p>
            <p>Posted {{ $user_complaint->created_at->diffForHumans() }}</p>
            <span><i class="fa fa-trash fa-sm pr-3" style="color: red;"></i><a href="{{ url('/confirm-delete-complaint' . '/' . $user_complaint->id) }}" class="text-danger ml-2 text-sm"> Delete this complaint</a></span>
        </div>

    @empty 
        <p>You haven't made any complaints!</p>
        <a href="{{ url('/send-complaint') }}">Send a Complaint</a>
    @endforelse

    {!! $users_complaints->links() !!}

@endsection
