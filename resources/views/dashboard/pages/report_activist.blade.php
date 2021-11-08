@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Report Activist</h5>
        <a href="{{ url('/activist-details' . '/' . $id) }}" class="text text-primary">Back</a>
    </div>

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

    <div class="app-card app-card-settings shadow-sm p-4">

        <div class="app-card-body">
            <form class="settings-form" action="{{ route('report.activist') }}" method="POST">
                @csrf 
                @method('POST')
                <input type="hidden" name="reported_user" value="{{ $id }}">
                <input type="hidden" name="reporting_user" value="{{ auth()->user()->id }}">
                <div class="mb-3">
                    <label for="setting-input-2" class="form-label">Details</label>
                    <textarea type="text" class="form-control" style="height: 10rem"  placeholder="What is the problem?" name="details"  rows="5" required></textarea>
                </div>
              
                <button type="submit" class="btn app-btn-primary">Report Activist</button>
            </form>
        </div>
       
    </div>

@endsection