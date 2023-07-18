<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerClicks;
use App\Models\Region;
use App\Models\Applications;
use App\Models\User;
use App\Models\Distric;
use App\Models\Profile;
use App\Models\Conversation;
use App\Models\Chat;
use Validator;
use Auth;
class CustomerController extends Controller
{
    //
    public function dashboard(){
        $customerViews=CustomerClicks::where('customer_id',Auth::user()->id)->count();
        $applications=Applications::where('user_id',Auth::user()->id)->get();
        return view('customer.dashboard',compact('customerViews','applications'));
    }
    public function applications(){
        $regions=Region::all();
        $applications=applications::where('user_id',Auth::user()->id)->get();
        return view('customer.applications',compact('regions','applications'));
    }
    public function submitApplications(Request $request){
        $validate=Validator::make($request->all(),[
            
            'region'=>'required',
            'city'=>'required',
           'distric'=>'required',
            'house'=>'required',
            'budget'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        // dd($request->all());
        $application=Applications::create([
            'user_id'=>Auth::user()->id,
            'region_id'=>$request->region,
            // 'city_id'=>$request->city,
            'distric_id'=>$request->distric,
            'renovate'=>$request->renovate,
            'sea_view'=>$request->sea_view,
            'house'=>$request->house,
            'budget'=>$request->budget,
            'grage'=>$request->grage,
            'note'=>$request->note,
            'approved'=>'0'
        ]);
        if($application){
            $application->city()->attach($request->city);
            return response()->json(['status'=>true,'message'=>'Application submitted successfully']);
            
        }else{
            return response()->json(['status'=>false,'message'=>'Application not submitted please try again']);
        }
    }
    public function startConversaction(Request $request){
        $uuid=$request->uuid;
        $conversaction=Conversation::where('uuid',$request->uuid)->where('customer_id',Auth::user()->id)->first();
       
       $chat= Chat::where('uuid',$conversaction->uuid)->get();
        // dd($conversaction->customer);
        foreach($chat as $ct){
            $ct->is_read=1;
            $ct->save();
        }
        return view('customer.conversaction',compact('uuid','conversaction','chat'));
    }
    public function getConversactions(){
        $conversaction=Conversation::where('customer_id',Auth::user()->id)->get();
        // dd(Auth::user()->id);
        return view('customer.conversaction_with_customer',compact('conversaction'));
    }
    public function profile(){
        $user=Auth::user();
        $regions=Region::all();
        $distric=Distric::where('id',$user->profile?$user->profile->distric_id:'')->first();
        // dd($user->profile);
        return view('customer.profile',compact('user','regions','distric'));
    }
    
    public function updateProfile(Request $request){
        
        
        // $role=Role::where('name','customer')->first();
       $user=User::find(Auth::user()->id);
        $userData=[
            'name'=>$request->name,
            // 'user_account_id'=>strtotime(date('Y-m-d H:i:s')),
            // 'email'=>$request->email,
            'surname'=>$request->surname,
            // 'password'=>bcrypt($request->password),
            // 'role_id'=>$role->id,
            // 'uuid'=>Str::uuid()->toString(),
            // 'activated'=>'1',
        ];
        $user->fill($userData);
        $user->save();
        if($user){
            $profileData=[
                // 'user_id'=>$user->id,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'current_living'=>$request->current_living,
                'region_id'=>$request->region,
                'distric_id'=>$request->distric,
                // 'address'=>$request->address,
                'adults'=>$request->adults,
                'childerns'=>$request->childerns,
                'house'=>$request->house,
                'budget'=>$request->budget,
                'grage'=>$request->grage,
                'sea_view'=>$request->seaview,
                'renovate'=>$request->renovate,
                'living_today'=>$request->living_today,
            ];
            $profile=Profile::where('user_id',$user->id)->first();
            $profile->fill($profileData);
            
            if($profile->save()){
                
                // $user->city->attach(array_values($request->city));
                if($request->city){
                    $profile->city->sync($request->city);
                }
                return response()->json(['status'=>true,'message'=>'Customer updated successfully']);
            }else{

                return response()->json(['status'=>false,'message'=>'Customer Not updated please try again']);
            }
        }else{
            return response()->json(['status'=>false,'message'=>'Customer not created please try again']);
        }
        
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
