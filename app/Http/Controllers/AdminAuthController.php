<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminAuthController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/user-home';


    public function login () {
        return view('admin.pages.auth.login');
    }
    public function create(Request $request)
    {
        $request->validate([

            'sign_username' => 'required|string|max:100|unique:users,username',
            'sign_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'sign_password' => ['required', 'string', 'min:6'],
        ]);


        $user = new User();
            $user->name = $request->sign_username;
            $user->username = $request->sign_username;
            $user->email= $request->sign_email;
            $user->password = Hash::make($request->sign_password);
            $user->mobile = $request->mobile;
            $user->credit_balance = 0;
            $user->singUp_credit = 0;
            $user->save();


//        $mailData = [
//            'name' => $data['sign_username'],
//        ];
//        $this->sendEmail('email.email-welcome',$mailData ,'Welcome to adi.com.bd', $data['sign_email']);
//        return  $user;
        return redirect('/register')
            ->with(['type'=>'success','message'=>'You have registered Successfully']);
    }
}
