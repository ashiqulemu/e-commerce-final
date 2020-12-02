<?php

namespace App\Http\Controllers\Auth;
use App\id;
use App\Http\Controllers\Controller;
use Illuminate\Auth\SessionGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Cart;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user-home';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    protected function authenticated(Request $request, $user)
    {
        if(!$user->is_active){
            Auth::logout();
            return redirect('/');
        }
        if(($user->role === 'admin' || $user->role === 'sub-admin') && $request->input('from') == 'ad'){
            return redirect('/admin/dashboard');


        }else if($user->role === 'user' || $user->role==='agent' && $request->input('from') == 'st'){
            Cart::merge(auth()->user()->id);
            return redirect('/user-home');

        }else {
            Auth::logout();
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        $this->cartStore();
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function eraseCartItem($identifier) {
        $instanceItem = DB::table('shoppingcart')->whereIdentifier($identifier)->first();
        if($instanceItem){
            DB::table('shoppingcart')->whereIdentifier($identifier)->delete();
        }

    }

    public function cartStore() {
        if(auth()->user()->id){
            $this->eraseCartItem(auth()->user()->id);
            if(Cart::content()->count()){
                Cart::store(auth()->user()->id);
            }
        }
    }
    public function redirect()
    {
        
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {

        try {
            
            $fbuser = Socialite::driver('facebook')->user();

            $user = DB::table('users')
                ->select('id')
                ->where('email', $input['email'] = $fbuser->getEmail())
                ->first();
               
            $input['name'] = $fbuser->getName();
            $input['email'] = $fbuser->getEmail();
//              $input['provider'] = $provider;
            $input['facebook'] = $fbuser->getId();

            if ($user == Null) {

                $usero = User::create([
                    'name' => $input['name'],
                    'username' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['facebook']),

                ]);
              

                Auth::loginUsingId($usero->id,TRUE);

                return redirect('/user-home');
                }else{

                Auth::loginUsingId($user->id,TRUE);
                
                return redirect('/user-home');
            }

         }
        catch (Exception $e)
         {
             return redirect('/');
         }
        }
}
