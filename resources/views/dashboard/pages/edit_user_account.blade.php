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
                <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                    <div class="d-flex flex-column align-content-end">
                        <div class="app-auth-body mx-auto">	
                            <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="{{ asset('dashboard_assets/images/app-logo.svg') }}" alt="logo"></a></div>
                            <h2 class="auth-heading text-center mb-4">Edit Account</h2>	

                            @if(Session::has('success'))
                            
                                <span class="text text-success">{{ Session::get('success') }}</span>
                                <br><br>
                            @elseif (Session::has('error'))
                                <br>
                                <span class="text text-danger">{{ Session::get('error') }}</span>
                            @endif
            
                            <div class="auth-form-container text-start mx-auto">
                                <form method="POST" action="{{ route('account.update') }}" class="auth-form auth-signup-form">     
                                    @csrf 
                                    @method('PUT')    

                                    <input type="hidden" name="id" value="{{ Auth()->user()->id }}">
        
                                    @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
        
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-name">Your Name</label>
                                        <input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="{{ $user_account->name }}" value="{{ $user_account->name }}" required="required">
                                    </div>
        
                                    @if ($errors->has('email'))
                                       <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
        
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-email">Your Email</label>
                                        <input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="{{ $user_account->email }}" value="{{ $user_account->email }}" required="required">
                                    </div>

                                    @if ($errors->has('contact'))
                                       <span class="text-danger">{{ $errors->first('contact') }}</span>
                                    @endif
     
                                 <div class="contact mb-3">
                                     <label class="sr-only" for="signup-email">Your Contact</label>
                                     <input id="signup-contact" name="contact" type="contact" class="form-control signup-contact" placeholder="{{ $user_account->contact != null ? $user_account->contact : 'Contact'}}" value="{{ $user_account->contact != null ? $user_account->contact : ''}}">
                                 </div>

                                 @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                 @endif

                                 @if(Auth()->user()->type == 1)

                                    <div class="type mb-3">
                                        <label class="sr-only" for="signup-email">User Type</label>
                                        <select name="type" class="form-control pl-2 pb-1">
                                            <option value="">Select User Type</option>
                                            <option value="3" {{ $user_account->type == 3 ? 'selected' : '' }}>Victim</option>
                                            <option value="2" {{ $user_account->type == 2 ? 'selected' : '' }}>Activist</option>
                                            <option value="1" {{ $user_account->type == 1 ? 'selected' : '' }}>Administrator</option>
                                        </select>
                                    </div>

                                 @else 
                                    <input type="hidden" name="type" value="{{ Auth()->user()->type }}">
                                 @endif
        
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
        
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">New Password</label>
                                        <input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Create New password">
                                    </div>
        
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
        
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">Repeat New Password</label>
                                        <input id="signup-password" name="password_confirmation" type="password" class="form-control signup-password" placeholder="Repeat New Password">
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Save Progress</button>
                                    </div>
                                </form><!--//auth-form-->
                            </div><!--//auth-form-container-->	
                            
                            
                            
                        </div><!--//auth-body-->
                    	
                    </div>  
                </div>
               
            
            </div>

        </div>
    </div>

@endsection