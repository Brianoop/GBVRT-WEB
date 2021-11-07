@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Send Complaint</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>
    
    <div class="app-card app-card-settings shadow-sm p-4">

        @if($errors->any())

            <div class="alert alert-danger">
               
                 <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
                 </ul>
            </div>

        @endif

        @if(Session::has('status'))

        <div class="{{ Session::get('status') == true ? 'alert alert-success' : 'alert alert-danger'}}">
            {{ Session::get('message') }}
        </div>

        @endif

        <div class="app-card-body">
            <form class="settings-form" method="POST" action="{{ route('user.complaint') }}">
                @csrf 
                @method('POST')
                <div class="mb-3">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <label for="setting-input-2" class="form-label">Details</label>
                    <textarea type="text" class="form-control"  placeholder="What is the problem?" name="content"  rows="5" style="height: 10rem;" required></textarea>
                </div>
              
                <div class="send-complaint-buttons">
                    <button type="submit" class="btn app-btn-primary">Send Complaint</button>
                    <a href="{{ route('my.complaints') }}">My Complaints</a>
                </div>
            </form>
        </div>
        <!--//app-card-body-->

    </div>

@endsection