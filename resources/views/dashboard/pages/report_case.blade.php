@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Report Case</h5>
        <a href="#" class="text text-primary">Back</a>
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
                    <form method="POST" action="{{ route('case.report') }}" class="settings-form" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Location of incident</label>
                            @error('victim_location')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" placeholder="Location" name="victim_location">
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Name of affected person</label>
                            @error('victim_name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" placeholder="{{ auth()->user()->name }}" name="victim_name">
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Phone number to reach you on</label>
                            @error('victim_contact')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" placeholder="Your contact" name="victim_contact">
                        </div>

                     

                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Details of offense</label>
                            @error('details')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <textarea type="text" class="form-control"
                                placeholder="Briefly describe what happened and how you wish to be contacted" name="details"
                                value="{{ old('details') }}" rows="5" required style="height: 10rem;"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Choose activist to forward case to</label>
                            <select name="activist" id="activist" class="form-control">
                                <option value="0">Forward to All</option>
                                @if(count($activists) > 0)

                                    @foreach($activists as $activist)

                                        <option value="{{ $activist->id }}">{{ $activist->name }}</option>

                                    @endforeach

                                @endif

                            </select>
                        </div>

                        <div class="mb-3">
                            @error('files')
                                <span class="text text-danger">{{ $message }}</span><br>
                            @enderror
                            <label for="setting-input-3" class="form-label">Upload photos or videos for proof if any</label> <br>
                            <input type="file" name="files[]" class="form-control-file" multiple=''>
                        </div>
                        <button type="submit" class="btn app-btn-primary">Save Case</button>
                    </form>
                </div>
               

            </div>
    
        </div>
    </div>

@endsection
