@extends('dashboard.layouts.default')

@section('content')
    <div class="content-navigation-section">
        <h5>Activist Case Detail</h5>
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
                    <strong>Case ID</strong>
                    <p>{{ $user_case->id }}</p>
                </div>

                <div class="col-md-12">
                    <strong>Location</strong>
                    <p>{{ $user_case->victim_location }}</p>
                </div>

                <div class="col-md-12">
                    <strong>Details</strong>
                    <p>{{ $user_case->details }}</p>
                </div>
                <div class="col-md-12">
                    <strong>Phone Number</strong>
                    <p>{{ $user_case->victim_contact }}</p>
                </div>
                <div class="col-md-12">
                    <strong>Case Status</strong>
                    <p>{{ $user_case->case_status }}</p>
                </div>

                <form action="{{ url('/save-feedback') }}" method="POST">
                    @csrf
                    <input type="hidden" name="case_id" value="{{$user_case->id }}">
                    <input type="hidden" name="given_by" value="{{ auth()->user()->id }}">
                    <label for="Send Feedback" class="text-success">Send Feedback</label> <br>
                    <textarea  class="form-control pt-2 pb-2 mt-2" name="feedback" id="" cols="30" rows="10" style="height: 10em;"></textarea>
                    <button type="submit" class="btn-success mt-2" style="padding: .2em .7em; border-radius: .1em; color: white; ">Send</button>
                </form>

               

                
            </div>
        </div>

    @endisset

    @foreach($feedback as $feed)

        @if($feed->given_by == auth()->user()->id)
            <div class="alert alert-success mt-2">
                <span>me {{ $feed->created_at->diffForHumans() }}</span>
                <p>{{ $feed->feedback }}</p>
            </div>
        @else
            <div class="alert alert-success">
                <span> {{ $feed->name . ' ' . $feed->created_at->diffForHumans() }}</span>
                <p>{{ $feed->feedback }}</p>
            </div>
        @endif

    @endforeach

    {!! $feedback->links() !!}


    <script>
        var case_id = "{{ $user_case->id }}";
        

        $(document).ready(function() {

            var _token = $("input[name='_token']").val();

            $("#delete-btn").click(function() {
                var proceed = confirm("DELETE this case?");
                if (proceed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ URL::to('delete-user-case') }}",
                        data: JSON.stringify({
                            case_id,
                            _token
                        }),
                        contentType: "application/json",
                        processData: true,
                        success: function(response) {
                            console.log(response);

                            if (response == "success") {
                                alert('Case deleted successfully!');
                                window.location.href =
                                    "{{ url('/user-cases') }}";
                            } else {
                                alert('Failed to delete case!');

                            }
                        },
                        error: function(data, textStatus, errorThrown) {
                            console.log(data);

                        },
                    });
                }
            });
        });
    </script>
@endsection
