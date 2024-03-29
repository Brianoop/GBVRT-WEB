@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Create Sub County</h5>
        <a href="{{ route('subcounties.view') }}" class="text text-primary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                   @if(Session::has('success'))
                       <div class="alert alert-success">
                            <span class="text text-success">{{ Session::get('success') }}</span>
                       </div>
                   @elseif (Session::has('error'))
                        <div class="alert alert-danger">
                            <span class="text text-danger">{{ Session::get('error') }}</span>
                        </div>
                   @endif


                <div class="app-card-body">
                    <form method="POST" action="{{ route('subcounty.save') }}" class="settings-form">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Name<span class="ms-2"
                                    data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="The name of the Sub County."></span></label>
                            @error('name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" name="name" placeholder="Name of Sub County">
                        </div>

                    
                 
                        <button type="submit" class="btn app-btn-primary">Save </button>
                    </form>
                </div>
               

            </div>
    
        </div>
    </div>

@endsection
