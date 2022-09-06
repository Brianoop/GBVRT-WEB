@extends('dashboard.layouts.default')

@section('content')
    <div class="content-navigation-section">
        <h5>Manage Cases</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">
        <hr>

        <div class="alert alert-info">
            All Cases ( {{ $case_number }} )
        </div>
        <br>
        {{-- <div class="alert alert-info">
            Closed Cases (10)
        </div> --}}
        <hr>
        <div class="row">

            @foreach ($cases as $case)
                <div class="col-md-4">
                    <div class="card shadow-sm bg-light p-2 m-1" style="height: 16rem;">
                        <div>
                            <label for="" style="font-size: 0.9rem; font-weight: bold;"><span
                                    style="padding-right: 1rem;"><i
                                        class="fa fa-user-circle fa-sm text-warning"></i></span>{{ $case->name }}</label>
                            <a href="#" style="float: right; margin-right: 0.4rem;"><span><i
                                        class="fa fa-ellipsis-h fa-sm text-secondary"></i></span></a>
                        </div>
                        <hr>
                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-tag text-danger shawdowm-sm"></i></span>{{ $case->email }}</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-map fa-sm text-secondary shawdowm-sm"></i></span>{{ $case->victim_location }}</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-book-open fa-sm text-info shawdowm-sm"></i></span> Status:
                            {{ $case->case_status }}</label>

                        <label for="" style="font-size: 0.9rem; font-weight: normal;"><span
                                style="padding-right: 1rem;"><i
                                    class="fa fa-calendar-alt fa-sm text-primary shawdowm-sm"></i></span> Reported on
                            {{ date(' d F Y,  g:i A', strtotime($case->created_at)) }}</label>


                        <br>
                        {{-- <div class="d-flex flex-row">
                        <a href="{{ url('/view-case-detail-as-admin') }}"
                            class="btn btn-outline-info btn-sm  shadow-sm text-sm"><span style="padding-right: 1rem;"><i
                                    class="fa fa-eye fa-sm shadow-sm"></i></span><span
                                style="font-size: 0.8rem;">View</span></a>
                        <a href="#" class="btn btn-outline-secondary btn-sm  shadow-sm text-sm"><span
                                style="padding-right: 1rem;"><i class="fa fa-cog fa-sm shadow-sm"></i></span><span
                                style="font-size: 0.8rem;">Manage</span></a>
                    </div> --}}
                    </div>
                </div>
            @endforeach

            {!! $cases->links() !!}

        </div>

    </div>
@endsection
