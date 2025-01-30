<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Clients;
use App\Models\Employees;
use App\Models\projects;
use App\Models\Settings;
use App\Models\RefarralPointsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $currentuserid = $request->currentuserid;
        $result = array();

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string',
            'contactno' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'about' => 'required|string',
        ]);

      
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }
        else{

            $currentuser = User::find($currentuserid);
            $currentuser->firstname = $request->firstname;
            $currentuser->lastname = $request->lastname; 
            $currentuser->email = $request->email; 
            $currentuser->phone = $request->contactno;        
            $currentuser->save();
    
            if($currentuser->usertype==2){
                $clientdata=Clients::where('user_id',$currentuserid)->first();
                if(isset($clientdata->id)){
                    $clientdata=Clients::find($clientdata->id);
                    $clientdata->address=$request->address;
                    $clientdata->country=$request->country;
                    $clientdata->about=$request->about;
                }
                    
                else{
                    $clientdata = Clients::create([
                        "user_id" => $currentuserid,
                        "address" => $request->address,
                        "country" => $request->country,
                        "about" => $request->about
                    ]);
                }           
                $clientdata->save();
            }        
            
            if($currentuser->usertype==3){
                $employeedata= Employees::where('user_id',$currentuserid)->first();
                
                if($request->file('cvfile')){
                    $file = $request->file('cvfile');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads', $fileName, 'public');
                }
                
                if($request->file('imagefile')){
                    $imagefile = $request->file('imagefile');
                    $imagefileName = time() . '_' . $imagefile->getClientOriginalName();
                    $imagefile->storeAs('uploads', $imagefileName, 'public');
                }
                
                if(isset($employeedata->id)){
                    $employeedata= Employees::find($employeedata->id);
                    $employeedata->address=$request->address;
                    $employeedata->country=$request->country;
                    $employeedata->about=$request->about;
                }
                else{
                    $employeedata = Clients::create([
                        "user_id" => $currentuserid,
                        "address" => $request->address,
                        "country" => $request->country,
                        "about" => $request->about
                    ]);
                }         
                
                
                if($request->file('cvfile')) {
                    $employeedata['cv'] = $fileName;
                }

                // Check if 'profile_image' has a value before adding it to the update array
                if ($request->file('imagefile')) {
                    $employeedata['profile_image'] = $imagefileName;
                }
                
                $employeedata->save();
            }    
            
            $details = User::where('id', $currentuserid)->with('Client')->with('employee_profile')->first();
            $result['userdetails'] = $details;
            $result['code'] = '200';
            $result['status'] = 'success';
            $result['message'] = 'User data successfully Updated';
            return $result;
        }
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(User $user)
    {
        //
    }

    public function GetuserDetails(Request $request)
    {
        $currentuserid = $request->currentuserid;
        $result = array();
        $details = User::where('id', $currentuserid)->with('Client')->with('employee_profile')->first();
        $result['userdetails'] = $details;
        $result['code'] = '200';
        $result['status'] = 'success';
        $result['message'] = 'User data successfully fetched';
        return $result;
    }

    public function userlogout(Request $request)
    {
        //Auth::user()->tokens()->delete();
        // return response()->json([
        //     'message' => 'Successfully logged out',
        // ]);
        $user = User::find($request->currentuserid);
        // $user->tokens()->delete();
        $result['code'] = '200';
        $result['status'] = 'success';
        $result['message'] = 'User logout successfully';
        return response()->json($result);
    }
    
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'newPassword' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($request->currentuserid);

        // Update the user's password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }
    
    
    public function getDashboardData(Request $request)
    {
        $currentuserid = $request->currentuserid;
        $result = array();
        if($currentuserid){
            $result['code'] = '200';
            $result['message'] = 'success';
        }
        // super admin portion 
        if($request['authuser']->usertype == '1'){
            
            $latest_project = projects::where('status','!=','3')->orderBy('id', 'DESC')->limit(5)->get();
            $total_project =  projects::where('status', '1')->count('id');
            $total_emp = User::where('usertype','3')->count('id');
            $total_client = User::where('usertype','2')->count('id');
            
            $result['latest_project'] = $latest_project;
            $result['total_project'] = $total_project;
            $result['total_emp'] = $total_emp;
            $result['total_client'] = $total_client;
            return response()->json($result);
        }
        
        // client portion 
        if($request['authuser']->usertype == '2'){
            
            $latest_project = projects::where('client_id', $currentuserid)->where('status','!=','3')->orderBy('id', 'DESC')->limit(5)->get();
            $total_project = projects::where('client_id', $currentuserid)->where('status', '1')->count('id');
            $refarrel_data = Clients::where('user_id',$currentuserid)->first();
            
            $result['latest_project'] = $latest_project;
            $result['total_project'] = $total_project;
            $result['refarrel_data'] = $refarrel_data;
            return response()->json($result);
        }
        
        // employee portion 
        if($request['authuser']->usertype == '3'){
            
            $latest_project = projects::whereJsonContains('selectedemployeeid', (string) $currentuserid)->where('status','!=','3')->orderBy('id', 'DESC')->limit(5)->get();
            $total_project = projects::whereJsonContains('selectedemployeeid', (string) $currentuserid)->where('status', '1')->count('id');

            $result['latest_project'] = $latest_project;
            $result['total_project'] = $total_project;
            return response()->json($result);
        }
        
        
      
    }
    
    
    public function oneClickLogin(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        // return $user;
        
        $expiresAt = now()->addDays(7);
        $token = $user->createToken('auth_token', ['*'], $expiresAt)->plainTextToken;
        
        $result['code'] = '200';
        $result['status'] = 'success';
        $result['message'] = 'Login Successfull';
        $result['user']=$user;
        $result['authorization']=[
            'token' => $token,
            'type' => 'bearer',
            'usertype' => $user->usertype,
        ];                     
        return response()->json( $result);
       
    }
    
     public function updateUserImageData(Request $request)
    {
        $currentuserid = $request->currentuserid;
        $result = array();

        $validator = Validator::make($request->all(), [
            'imagefile' => 'required',
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }
        else{

            $employeedata= Employees::where('user_id',$currentuserid)->first();
               
            if($request->file('imagefile')){
                $imagefile = $request->file('imagefile');
                $imagefileName = time() . '_' . $imagefile->getClientOriginalName();
                $imagefile->storeAs('uploads', $imagefileName, 'public');
            }
            
            if(isset($employeedata->id)){
                $employeedata= Employees::find($employeedata->id);
            }         
            
            // Check if 'profile_image' has a value before adding it to the update array
            if ($request->file('imagefile')) {
                $employeedata['profile_image'] = $imagefileName;
            }
            
            $employeedata->save();
         
            $details = User::where('id', $currentuserid)->with('client_profile')->with('employee_profile')->first();
            $result['userdetails'] = $details;
            $result['code'] = '200';
            $result['status'] = 'success';
            $result['message'] = 'User data successfully Updated';
            return $result;
        }
    }
    
    
    
    
    public function addNewClient(Request $request){
        // Check all the fileds have valid data 
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json($errors, 400);
        }

        try {
            // Create a new client and insert data into user table
            $clientData = User::create([
                'firstname' => $request->input('first_name'),
                'lastname' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')), 
                'usertype' => '2',
            ]);
            
            // Insert data into client table if the user id created 
            if($clientData->id){
                $code = random_int(100000, 999999);
              
                Clients::create([
                    'user_id' => $clientData->id, 
                    'country' => $request->input('country'), 
                    'about' => $request->input('about'),
                    'address' => $request->input('address'),
                    'refarralcode' => 'RC'.$code,
                    'refarralpoints' => '0',
                ]);
                
                $referralCode = $request->input('referral_code');
                
                if(isset($referralCode)){
                
                    $refarralclientData = Clients::where('refarralcode', $request->input('referral_code'))->first();
                    if($refarralclientData){
                        $settings = Settings::where('option_lable', 'refarral_points')->first();
                        // $client->refarralpoints = $settings->option_value;
                        $refarralclientData->refarralpoints = $refarralclientData->refarralpoints+$settings->option_value;
                        $refarralclientData->save();
                        
                        $RefarralPointsTransaction = RefarralPointsTransaction::create([
                            'client_id' =>  $refarralclientData->user_id, 
                            'referred_by' =>  $clientData->id,
                            'usertype' => '2',
                            'refarralpoints' => $settings->option_value, 
                            'status' => 'cr',
                            'note' => "You have got ".$settings->option_value." points because of a new registration has been done through your referral code.",            
                        ]);
                        
                    }
                }
                
            }else{
                return response()->json(['message' => 'Faild To Save Data Something Went Wrong!'],422);
            }

            
            $user = User::where('id', $clientData->id)->first();
            // return $user;
            
            $expiresAt = now()->addDays(7);
            $token = $user->createToken('auth_token', ['*'], $expiresAt)->plainTextToken;
            
            $result['code'] = '200';
            $result['status'] = 'success';
            $result['message'] = 'Registration Successfull';
            $result['user']=$user;
            $result['authorization']=[
                'token' => $token,
                'type' => 'bearer',
                'usertype' => $user->usertype,
            ];          
    
            return response()->json( $result);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }

}
