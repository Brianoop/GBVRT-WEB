@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Activist Detail</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="app-card app-card-notification shadow-sm mb-4">
                <div class="app-card-header px-4 py-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-lg-auto text-center text-lg-start">
                            <img class="profile-image" src="{{ asset($activist->activist_avatar) }}"
                                alt="">
                        </div>
                        <div class="col-12 col-lg-auto text-center text-lg-start">
                            <div class="notification-type mb-2"><span class="badge bg-info">{{ $activist->activist_name }}</span>
                            </div>
                            <h4 class="notification-title mb-1">{{ $activist->organisation_name }}</h4>

                            <ul class="notification-meta list-inline mb-0">
                                <li class="list-inline-item">Joined {{ $activist->created_at->diffForHumans() }}</li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="notification-content">{{ $activist->detailed_description }}</div>
                </div>
                <div class="app-card-footer px-4 py-3 activist-messaging-actions">

                    <a class="action-link" href="#">Message Us!<svg width="1em" height="1em" viewBox="0 0 16 16"
                        class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                    </svg></a> 

                    <a class="action-link ml-5" href="{{ url('/report-activist' . '/' . $activist->activist_id ) }}">Report</a> 
                    
                </div>
            </div>
        </div>
    </div>

    <h6>Our Services</h6>
    <div class="row">
        <div class="col-md-12">
            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                </svg>
                            </div>

                        </div>
                        <div class="col-auto">
                            <h4 class="app-card-title">Services</h4>
                        </div>
                    </div>
                </div>
                <div class="app-card-body px-4 w-100">

                    @forelse($activist_services as $service)

                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>{{ $service->name }} </strong></div>
                                    <div class="item-data">{{ $service->description }}</div>
                                </div>

                            </div>
                        </div>

                    @empty 
                        <i>There are currently no available services by this activist.</i>
                    @endforelse

                </div>


            </div>

        </div>
    </div>

@endsection
