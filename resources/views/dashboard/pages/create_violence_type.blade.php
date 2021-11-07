@extends('dashboard.layouts.default')

@section('content')


    <div class="content-navigation-section">
        <h5>Create Violence Type</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                   @if(Session::has('success'))
                        <span class="text text-success">{{ Session::get('success') }}</span>
                   @elseif (Session::has('error'))
                        <span class="text text-danger">{{ Session::get('error') }}</span>
                   @endif


                <div class="app-card-body">
                    <form method="POST" action="{{ route('violence.save') }}" class="settings-form">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Name<span class="ms-2"
                                    data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="The name of the type of violence."></span></label>
                            @error('name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" name="name" placeholder="Name of violence">
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Description<span class="ms-2"
                                    data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="A description contains more information about a certain topic."></span></label>
                            @error('description')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <textarea name="description" id="" cols="30" rows="10" class="form-control" style="height: 10rem;"></textarea>
                        </div>
                 
                        <button type="submit" class="btn app-btn-primary">Save </button>
                    </form>
                </div>
               

            </div>
    
        </div>
    </div>

@endsection
