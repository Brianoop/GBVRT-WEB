@extends('dashboard.layouts.default')

@section('content')

 
    <div class="content-navigation-section">
        <h5>View Activists</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="row">
        
        @if(count($activists) > 0)

            @foreach($activists as $activist)

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
                                <h4 class="notification-title mb-1">{{ $activist->organisation_name ?? 'Organization' }}</h4>
    
                                <ul class="notification-meta list-inline mb-0">
                                    <li class="list-inline-item">Joined {{ $activist->created_at->diffForHumans() }}</li>
                                </ul>
    
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body p-4">
                        <div class="notification-content">{{ $activist->brief_description }}</div>
                    </div>
                    <div class="app-card-footer px-4 py-3">
                        <a class="action-link" href="{{ url('/activist-details' . '/' . $activist->activist_id ) }}">More information<svg width="1em" height="1em" viewBox="0 0 16 16"
                                class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                            </svg></a>
                    </div>
                </div>
            </div>

            @endforeach

            {!! $activists->links() !!}

        @else 
            <div class="alert alert-info">
                There are currently no available activists.
            </div>
        @endif

       

    </div>

@endsection
