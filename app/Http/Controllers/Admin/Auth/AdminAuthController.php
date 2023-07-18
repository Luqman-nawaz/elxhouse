<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AdminAuthController extends Controller
{
    //
    public function show_login(Request $request){
        return view('admin.auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required','password'=>'required',
        ]);
        
        $data=['email'=>$request->email,'password'=>$request->password,'is_admin'=>'1'];
        if(Auth::attempt($data)){
            // dd(Auth::user());
            if(Auth::user()->is_admin=='1'){
                return redirect()->route('admin.dashboard');
            }else{
                Auth::logout();
                return redirect()->route('admin.sigin');
            }
        }else{

            return redirect()->route('admin.sigin');
        }
    }
}
