@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Create New User</h5>
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
                            <h2 class="auth-heading text-center mb-4">Register A New User</h2>	

                            @if(Session::has('success'))
                                <br>
                                <span class="text text-success">{{ Session::get('success') }}</span>
                            @elseif (Session::has('error'))
                                <br>
                                <span class="text text-danger">{{ Session::get('error') }}</span>
                            @endif
            
                            <div class="auth-form-container text-start mx-auto">
                                <form method="POST" action="{{ route('account.create') }}" class="auth-form auth-signup-form">     
                                    @csrf 
                                    @method('POST')    
        
                                    @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
        
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-name">Your Name</label>
                                        <input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="Full name" value="{{ old('name') }}" required="required">
                                    </div>
        
                                    @if ($errors->has('email'))
                                       <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
        
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signup-email">Your Email</label>
                                        <input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="Email" value="{{ old('email') }}" required="required">
                                    </div>

                                    @if ($errors->has('contact'))
                                       <span class="text-danger">{{ $errors->first('contact') }}</span>
                                    @endif
     
                                 <div class="contact mb-3">
                                     <label class="sr-only" for="signup-email">Your Contact</label>
                                     <input id="signup-contact" name="contact" type="contact" class="form-control signup-contact" placeholder="Contact" value="{{ old('contact') }}" required="required">
                                 </div>

                                 @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                 @endif

                                 <div class="type mb-3">
                                    <label class="sr-only" for="signup-email">User Type</label>
                                    <select name="type" class="form-control pl-2 pb-1">
                                        <option value="" selected>Select User Type</option>
                                        <option value="3">Victim</option>
                                        <option value="2">Activist</option>
                                        <option value="1">Administrator</option>
                                    </select>

                                 </div>
        
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
        
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">Password</label>
                                        <input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Create a password" required="required">
                                    </div>
        
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
        
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signup-password">Repeat Password</label>
                                        <input id="signup-password" name="password_confirmation" type="password" class="form-control signup-password" placeholder="Repeat password" required="required">
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Register</button>
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