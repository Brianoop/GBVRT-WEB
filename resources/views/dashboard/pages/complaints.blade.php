@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Complaints</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>
  
    <div class="container">
        @if(auth()->user()->type == 1)

            @if(count($all_complaints) > 0)

                @foreach($all_complaints as $complaint)
                    <div class="alert alert-info my-3">
                        <strong>{{ $complaint->name }}</strong>
                        <hr>
                        <p class="text-sm">{{ $complaint->content }}</p>
                        <label for="date-posted">Posted {{ $complaint->created_at !== null ? $complaint->created_at->diffForHumans() : $complaint->created_at }}</label>
                        <hr>
                        <a href="{{ url('/confirm-delete-complaint' . '/' . $complaint->id ) }}" class="btn btn-outline-danger btn-sm  shadow-sm text-sm mb-3"><span style="padding-right: 1rem;"><i class="fa fa-trash fa-sm shadow-sm"></i></span><span style="font-size: 0.8rem;">Delete</span></a>
                       
                    </div>
                @endforeach
               
                {!! $all_complaints->links()  !!}
                
            @else
                    <div class="alert alert-info p-3 my-4">
                        <h5>There are currently no complaints to show here.</h5>
                    </div>
            @endif
        @endif
    </div>

@endsection