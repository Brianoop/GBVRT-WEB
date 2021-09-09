@extends('dashboard.layouts.default')

@section('content')

    <h5>Send Complaint</h5>
    <div class="app-card app-card-settings shadow-sm p-4">

        <div class="app-card-body">
            <form class="settings-form">
                <div class="mb-3">
                    <label for="setting-input-2" class="form-label">Details</label>
                    <textarea type="text" class="form-control"  placeholder="What is the problem?" name="compalint-detail" value="{{ old('complaint-detail') }}" rows="5" required></textarea>
                </div>
              
                <button type="submit" class="btn app-btn-primary">Send Complaint</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>

@endsection