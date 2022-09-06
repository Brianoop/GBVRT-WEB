@extends('dashboard.layouts.default')

@section('content')
    <div class="content-navigation-section">
        <h5>Case Detail</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="card shadow-sm p-3">
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

            @csrf

            <div class="col-md-12">
                <button id="delete-btn" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-sm"></i>
                    Delete</button>

            </div>
        </div>
    </div>

    @foreach ($activists as $activist)
        <div class="alert alert-info p-3 my-3">
            <h6>{{ $activist->activist_name }}</h6>
            <p>{{ $activist->activist_email }}</p>
            <p>{{ $activist->activist_contact }}</p>
            <p>({{ $activist->feedback_count }}) Feedback on this case</p>
            <a href="{{ url('/user-view-activist-feedback-on-case?case_id=' . $user_case->id . '&activist_id=' . $activist->activist_id ) }}" class="btn btn-success">View Activist</a>
        </div>
    @endforeach


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
