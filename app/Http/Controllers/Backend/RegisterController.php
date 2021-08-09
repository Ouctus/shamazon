<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use AuthenticatesUsers;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:vendors'],
            'contact_no' => ['required'],
        ]);

    }

    public function register(Request $request){

        $this->validator($request->all())->validate();

        $vendor = Vendor::create([
            'user_type'    => $request->user_type,
            'user_id'      => $request->user_id,
            'name_en'      => $request->first_name,
            'name_ar'      => $request->name_ar,
            'email'        => $request->email,
            'contact_no'   => $request->contact_no,
            'country_id'   => $request->country,
            'website'      => $request->website,
        ]);

        if($vendor->exists()){

            $vendor = $vendor->first();

            if(1==1){
                $vendor->status = 1;
                $vendor->save();
                Auth::guard('vendor')->login($vendor);
                return redirect()->intended('tdreeb-vendor/dashboard'); 
            }else{
                return 'code not match';
            }

        }
    }
}
