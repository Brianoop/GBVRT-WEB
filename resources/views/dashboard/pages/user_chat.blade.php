@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>My Chat</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            

            @isset($chat_messages)

                @foreach($chat_messages as $chat_message)
                    <div class='{{ $chat_message->sent_by == auth()->user()->id ? "alert alert-success text-sm" : "alert alert-info text-sm" }}'>
                        {{ $chat_message->sent_by == auth()->user()->id ? 'from me' : 'to me'}} <br>
                        <p>{{ $chat_message->message }}</p>
                        <span class="time-right">{{ $chat_message->created_at->diffForHumans() }}</span>
                    </div>
                @endforeach

                {!! $chat_messages->appends(request()->except('page'))->links() !!}

            @endisset

            

           
        </div>

        <div class="col-md-12">
            <form id="form" action="#" method="POST">
                @csrf
                <div class="mb-3">
                    @error('message')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                    <textarea  id="message" type="text" class="form-control"
                        placeholder="" name="message"
                        value="{{ old('message') }}" rows="5" required style="height: 7rem;"></textarea>
                </div>
                <button id="send-message" style="border-radius: 5px; background: dodgerblue; color: white; padding: .4em 1.5em; border-color: white;">Send</button>
            </form>
        </div>
    </div>

    <script>
        var uid = "{{ $uid}}";
        var rid = "{{ $rid}}";
        


        $(document).ready(function() {

            var _token = $("input[name='_token']").val();

            $('#form').submit(function(e) {
                e.preventDefault();
                var message = document.getElementById('message').value;
                $.ajax({
                        type: "POST",
                        url: "{{ URL::to('send-chat-message') }}",
                        data: JSON.stringify({
                            uid,
                            rid,
                            message,
                            _token
                        }),
                        contentType: "application/json",
                        processData: true,
                        success: function(response) {
                            console.log(response);
                            document.getElementById('message').value = "";
                           // alert(response);
                           window.location.reload();
                        },
                        error: function(data, textStatus, errorThrown) {
                            console.log(data);
                           // alert(data);


                        },
                    });
           
                });

            });

         
    </script>

@endsection
