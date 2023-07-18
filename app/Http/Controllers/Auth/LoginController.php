<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function authenticated(Request $request, $user)
    {
       
    if ($user->is_admin=='0' &&  $user->role->name=='customer') {// do your magic here
        $aftersixMonth=date('Y-m-d',strtotime('+6 months'));
        $created=date('Y-m-d',strtotime($user->created_at));
        if(strtotime($created>$aftersixMonth)){
            return redirect()->route('login')->with('error','your account has beed deactivated');
        }
        $user->last_login=date('Y-m-d H:i:s');
        $user->save();
        return redirect()->route('customer.dashboard');
    }elseif($user->is_admin=='0' && $user->role->name=='broker'){
        if($user->activated=='1'){
            $user->last_login=date('Y-m-d H:i:s');
            $user->save();
            return redirect()->route('broker.profile');
        }else{
            Auth::logout();
            return redirect()->route('login')->with('error','your account is not activated please contact addminstration to activate your account');
        }
    }
    
     return redirect()->route('login')->with('error','Invalid login details please try again');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
