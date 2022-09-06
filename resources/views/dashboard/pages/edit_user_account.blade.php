@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Edit User Account</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">

        <br>

        <div class="card p-4">
            <div class="row g-0 app-auth-wrapper">
                <div class="col-12 col-md-7 col-lg-12 auth-main-col text-center p-3">
                    <div class="d-flex flex-column align-content-end">
                        <div class="app-auth-body mx-auto">
                            <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img
                                        class="logo-icon me-2" src="{{ asset('dashboard_assets/images/app-logo.svg') }}"
                                        alt="logo"></a></div>
                            <h2 class="auth-heading text-center mb-4">Edit Account</h2>

                            @if (Session::has('success'))
                                <br>
                                <div class="alert alert-success p-3">
                                    <span class="text text-success">{{ Session::get('success') }}</span>
                                </div>
                            @elseif (Session::has('error'))
                                <br>
                                <div class="alert alert-danger p-3">
                                    <span class="text text-danger">{{ Session::get('error') }}</span>
                                </div>
                            @endif

                            <div class="auth-form-container text-start mx-auto">
                                <form method="POST" action="{{ route('account.update') }}"
                                    class="auth-form auth-signup-form">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $user_account->id }}">

                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif

                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-name">Your Name</label>
                                        <input id="signup-name" name="name" type="text"
                                            class="form-control signup-name" placeholder="{{ $user_account->name }}"
                                            value="{{ $user_account->name }}" required="required">
                                    </div>

                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif

                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-email">Your Email</label>
                                        <input id="signup-email" name="email" type="email"
                                            class="form-control signup-email" placeholder="{{ $user_account->email }}"
                                            value="{{ $user_account->email }}" required="required">
                                    </div>

                                    @if ($errors->has('contact'))
                                        <span class="text-danger">{{ $errors->first('contact') }}</span>
                                    @endif

                                    <div class="contact mb-3">
                                        <label class="sr-only" for="signup-email">Your Contact</label>
                                        <input id="signup-contact" name="contact" type="contact"
                                            class="form-control signup-contact"
                                            placeholder="{{ $user_account->contact != null ? $user_account->contact : 'Contact' }}"
                                            value="{{ $user_account->contact != null ? $user_account->contact : '' }}">
                                    </div>




                                    @if (auth()->user()->type == 2)
                                        @if ($errors->has('organisation_name'))
                                            <span class="text-danger">{{ $errors->first('organisation_name') }}</span>
                                        @endif


                                        <div class="type mb-3">
                                            <label class="sr-only" for="signup-email">Organisation Name</label>
                                            <input name="organisation_name" type="text"
                                                class="form-control signup-contact"
                                                placeholder="{{ $user_account->organisation_name != null ? $user_account->organisation_name : 'Organisation Name' }}"
                                                value="{{ $user_account->organisation_name != null ? $user_account->organisation_name : '' }}">
                                        </div>

                                        @if ($errors->has('brief_description'))
                                            <span class="text-danger">{{ $errors->first('brief_description') }}</span>
                                        @endif

                                        <div class="type mb-3">
                                            <label class="sr-only" for="signup-email">Brief Description</label>
                                            <input name="brief_description" type="text"
                                                class="form-control signup-contact"
                                                placeholder="{{ $user_account->brief_description != null ? $user_account->brief_description : 'Brief Description' }}"
                                                value="">
                                        </div>

                                        @if ($errors->has('detailed_description'))
                                            <span class="text-danger">{{ $errors->first('detailed_description') }}</span>
                                        @endif

                                        <div class="type mb-3">
                                            <label class="sr-only" for="signup-email">Detailed Description</label>
                                            <textarea name="detailed_description" class="form-control"
                                                value="{{ $user_account->detailed_description != null ? $user_account->detailed_description : '' }}" cols="30"
                                                rows="10" style="height: 8em;">{{ $user_account->detailed_description != null ? $user_account->detailed_description : '' }}</textarea>
                                        </div>
                                    @endif

                                    @if (auth()->user()->type == 1)
                                        @if ($errors->has('type'))
                                            <span class="text-danger">{{ $errors->first('type') }}</span>
                                        @endif

                                        <div class="type mb-3">
                                            <label class="sr-only" for="signup-email">User Type</label>
                                            <select name="type" class="form-control pl-2 pb-1">
                                                <option value="">Select User Type</option>
                                                <option value="3" {{ $user_account->type == 3 ? 'selected' : '' }}>
                                                    Victim</option>
                                                <option value="2" {{ $user_account->type == 2 ? 'selected' : '' }}>
                                                    Activist</option>
                                                <option value="1" {{ $user_account->type == 1 ? 'selected' : '' }}>
                                                    Administrator</option>
                                            </select>
                                        </div>
                                    @else
                                        <input type="hidden" name="type" value="{{ $user_account->type }}">
                                    @endif

                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif

                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">New Password</label>
                                        <input id="signup-password" name="password" type="password"
                                            class="form-control signup-password" placeholder="Create New password">
                                    </div>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif

                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">Repeat New Password</label>
                                        <input id="signup-password" name="password_confirmation" type="password"
                                            class="form-control signup-password" placeholder="Repeat New Password">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Save
                                            Progress</button>
                                    </div>
                                </form>
                                <!--//auth-form-->
                            </div>
                            <!--//auth-form-container-->



                        </div>
                        <!--//auth-body-->

                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
