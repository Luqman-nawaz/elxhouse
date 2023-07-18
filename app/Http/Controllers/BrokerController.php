<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\City;
use App\Models\User;
use App\Models\Profile;
use App\Models\Conversation;
use App\Models\CustomerClicks;
use App\Models\Chat;
use App\Models\Distric;
use App\Events\SendMail;
use Auth;
use DB;
use Illuminate\Support\Str;
// use Yajra\Datatables\Facades\Datatables;
use Datatables;

class BrokerController extends Controller
{
    //
public function dashboard(){
    
    return view('broker.dashboard');
}
public function customers(Request $request){
    $region_id=Auth::user()->profile?Auth::user()->profile->region_id:'';
    $regions=Region::where('id',$region_id)->get();
    $users=[];
    $selectedcity='';
   if($request->all()){
    $query=Profile::whereHas('user',function($row){
        return $row->where('role_id','!=','3');
    });
    
    if($request->city){
       $query->whereHas('city',function($row) use ($request){
            return $row->where('city_id',$request->id);
       });
       $cit=City::find($request->city);
       if($cit){

           $selectedcity=$cit->name;
       }
    }
    
        $region_id=Auth::user()->profile->region_id;
        $query->where('region_id',$region_id);
    
    if($request->distric){
        $query->where('distric_id',$request->distric_id);
    }
    if($request->grage){
        $query->orwhere('grage',$request->grage);
    }
    if($request->seaview){
        $query->orwhere('sea_view',$request->seaview);
    }
    if($request->renovate){
        $query->orwhere('renovate',$request->renovate);
    }
    $users=$query->get();
    // dd($users);
    foreach($users as $user){
        $exist=CustomerClicks::where('customer_id',$user->id)->where('broker_id',Auth::user()->id)->whereDate('created_at',date("Y-m-d"))->first();
        if(!$exist){
            // dd($user->user->role->name);

            if($user->user->role->name=='customer'){
                CustomerClicks::create(['customer_id'=>$user->id,'broker_id'=>Auth::user()->id]);
            }
        }
    }
    
   }
    $cities=City::where('region_id',Auth::user()->profile?Auth::user()->profile->region_id:'')->get();
    return view('broker.customers',compact('regions','cities','users','selectedcity'));
}
public function filteredCustomers(Request $request){
    $query=User::query();
    if($request->city){

        $query->city->whereIn('id',$ids);
    }
    if($request->region){
        $query->orWhere('region_id',$request->region);
    }
    if($request->distric){
        $query->orWhere('distric_id',$request->distric_id);
    }
    if($request->grage){
        $query->orWhere('grage',$request->grage);
    }
    if($request->seaview){
        $query->orWhere('sea_view',$request->seaview);
    }
    if($request->renovate){
        $query->orWhere('renovate',$request->renovate);
    }
    $users=$query->get();
    return Datatables::of(User::query())->make(true);
}

    public function startConversaction($id){
        $uuid=Str::uuid()->toString();
        $isExist=Conversation::where('customer_id',$id)->where('broker_id',Auth::user()->id)->first();
        if($isExist){
            $conversaction=$isExist;
            $isExist->save();
        }else{

            $conversaction=Conversation::create([
                'uuid'=>$uuid,
                'customer_id'=>$id,
                'broker_id'=>Auth::user()->id,
                'admin_id'=>'0'
            ]);
        }
       $chat= Chat::where('uuid',$conversaction->uuid)->get();
        // dd($conversaction->customer);
        foreach($chat as $ct){
            $ct->is_read=1;
            $ct->save();
        }
        return view('broker.conversaction',compact('uuid','conversaction','chat'));
    }
    public function getConversactions(){
        $conversaction=Conversation::where('broker_id',Auth::user()->id)->get();
       
        return view('broker.conversaction_with_customer',compact('conversaction'));
    }
    public function profile(){
        $user=Auth::user();
        $regions=Region::all();
        return view('broker.profile',compact('user','regions'));
    }
    public function updateProfile(Request $request){
        $user=User::find(Auth::user()->id);
        $userData=[
            'name'=>$request->name,
            'surname'=>$request->surname,
            
        ];
        $user->fill($userData);
        $user->save();
        if($request->password){

            $user->password=$request->password?bcrypt($request->password):'';
            $user->save();
        }
// dd($request->all());
        if($user){
            $profile=Profile::where('user_id',$user->id)->first();
            $profileData=[
                'user_id'=>$user->id,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'region_id'=>$request->region,
                // 'address'=>$request->address,
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
            ];
            $profile->fill($profileData);
            
            if($profile->save()){
                if($request->city){

                    $profile->city()->sync($request->city);
                }
                    // DB::table('city_profile')->insert(['profile_id'=>$profile->id,'city_id'=>$request->city]);
                
                // $user->city->attach(array_values($request->city));
                return response()->json(['status'=>true,'message'=>'Broker updated successfully']);
            }else{

                return response()->json(['status'=>false,'message'=>'Broker  not updated please try again']);
            }
        }else{
            return response()->json(['status'=>false,'message'=>'Broker  not updated please try again']);
        }
    }
    public function getCustomerDetail(Request $request){
        $user=User::where('id',$request->id)->first();
        $regions=Region::all();
        $distric=Distric::where('id',$user->profile?$user->profile->distric_id:'')->first();
        // dd($user->profile);
        return view('broker.customer_profile',compact('user','regions','distric'));
    }

public function logout(){
    Auth::logout();
    return redirect()->route('login');
}
}
