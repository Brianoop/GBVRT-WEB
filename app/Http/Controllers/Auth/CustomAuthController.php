<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('login');
        }
       
    }  


    public function showLoginPage()
    {
        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('dashboard.pages.login');
        }
    }

    public function showSignupPage()
    {
        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('dashboard.pages.signup');
        }
    }

    public function showDashboardHome() 
    {
      
            return view('dashboard.pages.home');
        
        
    }

    public function showForgotPasswordPage()
    {

        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('dashboard.pages.reset_password');
        }
    }
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $request->session()->regenerate();

            return redirect()->intended('dashboard-home')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('dashboard.pages.signup');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("signup")->withSuccess('You have registered');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut(Request $request) {
       // Session::flush();
       // Auth::logout();
  
      //  return redirect('login');

      Session::flush();

      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/');
    }
}
