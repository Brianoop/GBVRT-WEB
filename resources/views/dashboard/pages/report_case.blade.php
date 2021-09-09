@extends('dashboard.layouts.default')

@section('content')

    <h5>Report Case</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                   @if(Session::has('success'))
                        <span class="text text-success">{{ Session::get('success') }}</span>
                   @elseif (Session::has('error'))
                        <span class="text text-danger">{{ Session::get('error') }}</span>
                   @endif


                <div class="app-card-body">
                    <form method="POST" action="{{ route('case.report') }}" class="settings-form">
                        @csrf
                        @method('POST')




                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Location<span class="ms-2"
                                    data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
                            @error('location')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="setting-input-1" name="location"
                                value="{{ old('location') }}" placeholder="What is your current location?" required>
                        </div>
                        <div class="mb-3">
                            <label for="Violence Type" class="form-label">Violence Type</label>
                            <select name="violence" id="violence" class="form-control">
                                <option value="">Select Violence Type</option>
                                @if(count($violence) > 0)

                                    @foreach($violence as $offense)

                                        <option value="{{ $offense->id }}">{{ $offense->name }}</option>

                                    @endforeach

                                @endif
                                
                            </select>
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
                        <button type="submit" class="btn app-btn-primary">Save Case</button>
                    </form>
                </div>
                <!--//app-card-body-->

            </div>
            <!--//app-card-->
        </div>
    </div>

@endsection
