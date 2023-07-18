<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Region;
use App\Models\City;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Applications;
use App\Models\Profile;
use App\Models\Chat;
use App\Models\AdminRole;
use App\Models\Distric;

use Auth;
class AdminController extends Controller
{
    //
    public function dashboard(){
       
        $customer=User::whereHas('role',function($row){
            return $row->where('name','customer');
        })->count();
        $broker=User::whereHas('role',function($row){
            return $row->where('name','broker');
        })->count();
        return view('admin.dashboard',compact('broker','customer'));
    }
    public function regions(){
        $regions=Region::all();
        $cities=City::all();
        $districs=Distric::all();
        
        return view('admin.regions',compact('regions','cities','districs'));
    }
    public function addRegions(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required|unique:regions,name',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $create=Region::create(['name'=>$request->name]);
        if($create){
            return response()->json(['status'=>true,'message'=>'region added successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'region not added please try again']);
        }
    }
    public function addDistric(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required|unique:districs,name',
            'region'=>'required',
            'city'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        // dd($request->all());
        $create=Distric::create(['name'=>$request->name,'region_id'=>$request->region,'city_id'=>$request->city]);
        if($create){
            return response()->json(['status'=>true,'message'=>'region added successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'region not added please try again']);
        }
    }
    public function updateRegions(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $region=Region::find($request->region_id);
        $region->name=$request->name;
        if($region->save()){
            return response()->json(['status'=>true,'message'=>'region udpated successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'region not udpated please try again']);
        }
    }
    public function addCities(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required|unique:cities,name',
            'region'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $create=City::create(['name'=>$request->name,'region_id'=>$request->region]);
        if($create){
            return response()->json(['status'=>true,'message'=>'city added successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'city not added please try again']);
        }
    }
    public function udpateCities(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'region'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $city=City::find($request->city_id);
        // $create=City::create(['name'=>$request->name,'region_id'=>$request->region]);
        $city->name=$request->name;
        $city->region_id=$request->region;
        if($city->save()){
            return response()->json(['status'=>true,'message'=>'city updated successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'city not updated please try again']);
        }
    }
    public function updateDistric(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'region'=>'required',
            'city'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$validate->errors()],422);
        }
        $city=Distric::find($request->distric_id);
        // $create=City::create(['name'=>$request->name,'region_id'=>$request->region]);
        $city->name=$request->name;
        $city->region_id=$request->region;
        $city->city_id=$request->city;
        if($city->save()){
            return response()->json(['status'=>true,'message'=>'Distric updated successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'Distric not updated please try again']);
        }
    }
    public function customers(){
        $aftersix_moth=date('Y-m-d',strtotime('+6 months'));
        // dd($aftersix_moth);
        $users=User::whereHas('role',function($row){
            return $row->where('name','customer');
        })->whereDate('created_at','<=',$aftersix_moth)->get();
        // dd($users);
        return view('admin.customers',compact('users'));
    }
    public function disabledCustomers(){
        $aftersix_moth=date('Y-m-d',strtotime('+6 months'));
        $users=User::whereHas('role',function($row){
            return $row->where('name','customer');
        })->whereDate('created_at','>=',$aftersix_moth)->get();
        // dd($users);
        return view('admin.disabled_customers',compact('users'));
    }
    public function brokers(){
        $users=User::whereHas('role',function($row){
            return $row->where('name','broker');
        })->get();
        // dd($users);
        return view('admin.brokers',compact('users'));
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.sigin');
    }
    public function activateUser($id){
        $user=User::find($id);
        $user->activated=1;
        $user->save();
        return redirect()->back()->with('success','Broker Activated successfully');
    }
    public function deActivateUser($id){
        $user=User::find($id);
        $user->activated=2;
        $user->save();
        return redirect()->back()->with('success','Broker Deactivated successfully');
    }
    public function getConversactions(){
        $conversaction=Conversation::all();
        return view('admin.conversaction_with_customer',compact('conversaction'));
    }
    public function startConversaction(Request $request){
        // $uuid=Str::uuid()->toString();
        $conversaction=Conversation::where('uuid',$request->uuid)->first();
        $uuid=$request->uuid;
        
       $chat= Chat::where('uuid',$conversaction->uuid)->get();
        // dd($conversaction->customer);
        return view('admin.conversaction',compact('uuid','conversaction','chat'));
    }
    public function deleteRegion($id){
        $regions=Region::find($id);
        if($regions->delete()){
            return redirect()->back()->with('success','Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Not Deleted please try again');

        }
    }
    public function deleteCDistric($id){
        $regions=Distric::find($id);
        if($regions->delete()){
            return redirect()->back()->with('success','Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Not Deleted please try again');

        }
    }
    public function deleteCity($id){
        $city=City::find($id);
        if($city->delete()){
            return redirect()->back()->with('success','Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Not Deleted please try again');

        }
    }
    public function applications(){
        $applications=Applications::all();
        return view('admin.customer_applications',compact('applications'));
    }
    public function approveApplication(Request $request){
        $application=applications::find($request->id);
        $application->approved=1;
        $application->save();
        return redirect()->back()->with('success','Application approved successfully');
    }
    public function getDistrics(Request $request){
        // dd($request->all());
        $districs=Distric::where('city_id',$request->id)->get();
        $data=[];
        foreach($districs as $distric){
            $array=[
                'id'=>$distric->id,
                'name'=>$distric->name,
            ];
            array_push($data,$array);
        }
        if($data){

            return response()->json(['status'=>true,'data'=>$data]);
        }else{
            return response()->json(['status'=>false]);
        }
    }
    public function getCities(Request $request){
        // dd($request->all());
        $citics=City::where('region_id',$request->id)->get();
        $data=[];
        foreach($citics as $city){
            $array=[
                'id'=>$city->id,
                'name'=>$city->name,
            ];
            array_push($data,$array);
        }
        if($data){

            return response()->json(['status'=>true,'data'=>$data]);
        }else{
            return response()->json(['status'=>false]);
        }
    }
    public function generateCsv(Request $request){
        $aftersix_moth=date('Y-m-d',strtotime('+6 months'));
        $users=User::whereHas('role',function($row){
            return $row->where('name','customer');
        })->whereDate('created_at','<=',$aftersix_moth)->get();
        $filename = "customer.csv";
        $fp = fopen('php://output', 'w');
        $header=['id','name','surname','email','phone','addess','current living','region','distric','house','budget','created'];

        // dd('d');
        header('Content-Type: text/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fputcsv($fp, $header);
        $row=[];
        // dd('d');
        foreach($users as $user){

            $array=array(
                $user->user_account_id,
                $user->name,$user->surname,
                $user->email,$user->profile?$user->profile->phone:'',
                $user->profile?$user->profile->address:'',
                $user->profile?$user->profile->current_living:'',
                $user->profile?$user->profile->region->name:'',
                $user->profile?$user->profile->distric->name:'',
              $user->profile?$user->profile->house:'',
                $user->profile?$user->profile->budget:'',
                date('Y-m-d H:i:s',strtotime($user->created_at)),
            );
            fputcsv($fp,$array);
        }
        
        exit;
    }
    public function customerProfile(Request $request){
        $user=User::where('id',$request->id)->first();
        $regions=Region::all();
        $distric=Distric::where('id',$user->profile?$user->profile->distric_id:'')->first();
        // dd($user->profile);
        return view('admin.customer_profile',compact('user','regions','distric'));
    }
    public function brokerProfile(Request $request){
        $user=User::where('id',$request->id)->first();
        $regions=Region::all();
        return view('admin.broker_profile',compact('user','regions'));
    }
    public function updateBroker(Request $request){
        $user=User::find($request->id);
        $userData=[
            'name'=>$request->name,
            'surname'=>$request->surname,
            
        ];
        $user->fill($userData);
        $user->save();
        
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
                $profile->city()->sync($request->city);
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
    public function staffMember(){
        $roles=AdminRole::all();
        $members=User::where('is_admin','1')->get();
        return view('admin.staff_member',compact('roles','members'));
    }
    public function addMemeber(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>"required|email|unique:users,email",
            'password'=>'required',
            'role'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()],422);
        }
        $user=User::create([
            'name'=>$request->name,
            'surname'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'admin_role_id'=>$request->role,
            'is_admin'=>'1',
            'activated'=>'1',
        ]);
        if($user){
            return response()->json(['status'=>true,'message'=>'created successfully']);
        }else{
            
            return response()->json(['status'=>false,'message'=>'Not created please try again']);
        }
    }
    public function updateMemeber(Request $request){
        $user=User::find($request->user_id);
        $user->name=$request->name;
        $user->surname=$request->name;
        $user->email=$request->email;
        $user->admin_role_id=$request->role;
        if($request->password){
            $user->password=bcrypt($request->password);
        }
        if($user->save()){
            return response()->json(['status'=>true,'message'=>'udpated successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'not updated please try again']);
        }
    }
    public function deleteMember(Request $request){
        $user=User::find($request->id);
        if($user->delete()){
            return redirect()->back()->with('success','deleted successfully');
        }else{
            return redirect()->back()->with('error','not deleted please try again');
        }
    }
}
