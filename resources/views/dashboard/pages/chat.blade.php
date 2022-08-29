@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>My Chats</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-12">
           
            @isset($chats)
                @foreach($chats as $chat)
                    <div class="card darker mt-2 mb-2 p-2 shadow-sm">
                        <div style="display: flex; align-items: start; padding-bottom: 0.5rem;">
                            <strong class="pl-4">{{ $chat->creator->name . ' with ' . $chat->chatter->name}} </strong>
                        </div>

                        @if(auth()->user()->id == $chat->creator->id)
                           <a href="{{ url('/chat?uid=' . $chat->creator->id . '&rid=' . $chat->chatter->id ) }}">Open chat</a>
                        @else 
                           <a href="{{ url('/chat?uid=' . $chat->chatter->id . '&rid=' . $chat->creator->id ) }}">Open chat</a>
                        @endif
                        <span class="time-left"> Started chatting on {{ $chat->created_at->diffForHumans() }}</span>
                    </div>
                @endforeach
            @endisset

            

        </div>
    </div>

@endsection
