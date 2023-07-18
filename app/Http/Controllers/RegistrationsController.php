<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Role;
use App\Models\City;
use App\Models\User;
use App\Models\Profile;
use Validator;
use DB;
use Illuminate\Support\Str;
class RegistrationsController extends Controller
{
    //
    public function register(){
        $regions=Region::all();
        $roles=Role::where('name','!=','admin')->get();
        return view('registration.create_account',compact('regions','roles'));
    }
    public function getCities(Request $request){
        $cities=City::where('region_id',$request->region)->get();
        $data=[];
        foreach($cities as $city){
            $array=[
                'id'=>$city->id,
                'name'=>$city->name
            ];
        array_push($data,$array);
        }
        if($data){
            return response()->json(['status'=>true,'data'=>$data]);
        }else{
            return response()->json(['status'=>false]);
        }
    }
    public function createAccount(Request $request){
        
        
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'address'=>"required",
            'phone'=>"required",
            'current_living'=>'required',
            'region'=>'required',
            'distric'=>'required',
            'city'=>'required',
            'adults'=>'required',
            'childerns'=>'required',
            'house'=>'required',
            'budget'=>'required',
            'living_today'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $role=Role::where('name','customer')->first();
       
        $user=User::create([
            'name'=>$request->name,
            'user_account_id'=>strtotime(date('Y-m-d H:i:s')),
            'email'=>$request->email,
            'surname'=>$request->surname,
            'password'=>bcrypt($request->password),
            'role_id'=>$role->id,
            'uuid'=>Str::uuid()->toString(),
            'is_admin'=>'0',
            'activated'=>'1',
        ]);
        if($user){
            $profile=Profile::create([
                'user_id'=>$user->id,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'current_living'=>$request->current_living,
                'region_id'=>$request->region,
                'distric_id'=>$request->distric,
                'adults'=>$request->adults,
                'childerns'=>$request->childerns,
                'house'=>$request->house,
                'budget'=>$request->budget,
                'grage'=>$request->grage,
                'sea_view'=>$request->seaview,
                'renovate'=>$request->renovate,
                'living_today'=>$request->living_today,
            ]);
            if($profile){
                foreach($request->city as $city){
                    DB::table('city_profile')->insert(['profile_id'=>$profile->id,'city_id'=>$city]);
                }
                // $user->city->attach(array_values($request->city));
                return response()->json(['status'=>true,'message'=>$role->name.' created successfully']);
            }else{

                return response()->json(['status'=>false,'message'=>$role->name.' not created please try again']);
            }
        }else{
            return response()->json(['status'=>false,'message'=>$role->name.' not created please try again']);
        }
        
    }
    public function registerBroker(){
        $regions=Region::all();
        $roles=Role::where('name','!=','admin')->get();
        return view('registration.register_broker',compact('regions','roles'));
    }
    public function createBroker(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'address'=>"required",
            'phone'=>"required",
            'region'=>'required',
            'city'=>'required',
            'company_name'=>'required',
            'company_number'=>'required',
            
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $role=Role::where('name','broker')->first();
    //    dd($role);
        $user=User::create([
            'name'=>$request->name,
            'user_account_id'=>strtotime(date('Y-m-d H:i:s')),
            'email'=>$request->email,
            'surname'=>$request->surname,
            'password'=>bcrypt($request->password),
            'role_id'=>$role->id,
            'uuid'=>Str::uuid()->toString(),
            'activated'=>'0',
            'is_admin'=>'0',
        ]);
        if($user){
            $profile=Profile::create([
                'user_id'=>$user->id,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'region_id'=>$request->region,
                'current_living'=>'',
                'adults'=>'',
                'childerns'=>'',
                'house'=>'',
                'budget'=>'',
                'grage'=>'',
                'sea_view'=>'',
                'renovate'=>'',
                'company_name'=>$request->company_name,
                'company_number'=>$request->company_number,
            ]);
            if($profile){
                
                    DB::table('city_profile')->insert(['profile_id'=>$profile->id,'city_id'=>$request->city]);
                
                // $user->city->attach(array_values($request->city));
                return response()->json(['status'=>true,'message'=>$role->name.'created successfully']);
            }else{

                return response()->json(['status'=>false,'message'=>$role->name.' not created please try again']);
            }
        }else{
            return response()->json(['status'=>false,'message'=>$role->name.' not created please try again']);
        }
    }
}
