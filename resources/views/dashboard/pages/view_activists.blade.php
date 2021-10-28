@extends('dashboard.layouts.default')

@section('content')

    <h5>View Activists</h5>

    <div class="row">
        
        @if(count($activists) > 0)

            @foreach($activists as $activist)

            <div class="col-md-12">
                <div class="app-card app-card-notification shadow-sm mb-4">
                    <div class="app-card-header px-4 py-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                <img class="profile-image" src="{{ asset('dashboard_assets/images/profiles/profile-1.png') }}"
                                    alt="">
                            </div>
                            <div class="col-12 col-lg-auto text-center text-lg-start">
                                <div class="notification-type mb-2"><span class="badge bg-info">{{ $activist->name }}</span>
                                </div>
                                <h4 class="notification-title mb-1">A Human Rights Group</h4>
    
                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Joined 2 months ago</li>
                                </ul>
    
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body p-4">
                        <div class="notification-content">We are a human rights group committed to fighting violence against
                            women and children in Northern Uganda, Gulu.</div>
                    </div>
                    <div class="app-card-footer px-4 py-3">
                        <a class="action-link" href="{{ route('activist.details') }}">More information<svg width="1em" height="1em" viewBox="0 0 16 16"
                                class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                            </svg></a>
                    </div>
                </div>
            </div>

            @endforeach

        @endif

       

    </div>

@endsection
