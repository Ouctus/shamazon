<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
class LoginController extends Controller
{
   
    protected $redirectTo = '/seller/login';
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:seller')->except('logout');
    }

    
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        return $credentials;
    }

    protected function sendLoginResponse(Request $request)
    {
        // ...
        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended('seller/dashboard');
    }

    public function logout(Request $request)
    {
        if(Auth::guard('seller')->check()){

            Auth::guard('seller')->logout();

            return redirect('/seller');

        }else{

            return redirect('/seller');

        }
        
    }  
    
    public function sellerlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|exists:sellers',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('email','Email not found!');
        }
    
        if (Auth::guard('seller')->attempt(['email' => $request->email,'password' => $request->password])) {
            
            $user = Auth::guard('seller')->user();

              return redirect()->intended(route('seller.dashboard'));
        }

        return redirect()->back()->with('password','Password not match!');
      
    }
}
