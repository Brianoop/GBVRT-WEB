@extends('dashboard.layouts.default')

@section('content')


    <div class="content-navigation-section">

        <h5>User Cases <strong>( {{ $total }} )</strong></h5>
        <a href="#" class="text text-primary">Back</a>

    </div>

    <div class="row">

        @if ($total > 0)
            @foreach ($user_cases as $case)
                <div class="col-md-6 mb-1">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                        </svg>
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">{{ $case->case_id }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Location </strong></div>
                                        <div class="item-data">{{ $case->victim_location }}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Visible Name </strong></div>
                                        <div class="item-data">{{ $case->victim_name }}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Phone Number </strong></div>
                                        <div class="item-data">{{ $case->victim_contact }}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Details</strong></div>
                                        <div class="item-data">{{ $case->details }}</div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Activists</strong></div>
                                        <div class="item-data">All</div>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                        <!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                          
                            <a class="btn app-btn-secondary"
                                href="{{ url('/user-case-detail' . '/' . $case->id ) }}">Manage Case</a>
                        </div>
                        <!--//app-card-footer-->

                    </div>
                    <!--//app-card-->
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                You have not reported any case on the platform.
            </div>
        @endif

    </div>

    {!! $user_cases->links() !!}

@endsection
