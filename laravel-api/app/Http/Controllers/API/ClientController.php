<?php

namespace App\Http\Controllers\API;

use App\Models\Clients;
use App\Models\User;
use App\Models\RefarralPointsTransaction;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
   
    // Get all client list  
    public function getClientList()
    {       
        $clientData = Clients::with('user')->orderByDesc('id')->get();
        
        
        return response()->json([
            'message' => 'Success',
            'client_data' => $clientData,
        ],200);            
    }

    // Function for add a new client  
    public function addNewClient(Request $request){

        // Check all the fileds have valid data 
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();            
            // Return only the error messages in the desired format
            return response()->json(['message' => $errors], 400);
        }

        try {
            // Create a new client and insert data into user table
            $clientData = User::create([
                'firstname' => $request->input('first_name'),
                'lastname' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password_confirmation')), 
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
                
                // $referralCode = $request->input('referral_code');
                // if(isset($referralCode)){
                
                //     $refarralclientData = Clients::where('refarralcode', $request->input('referral_code'))->first();
                //     if($refarralclientData){
                //         $settings = Settings::where('option_lable', $request->input('refarral_points'))->first();
                //         // $client->refarralpoints = $settings->option_value;
                //         $refarralclientData->refarralpoints = $refarralclientData->refarralpoints+$settings->option_value;
                //         $refarralclientData->save();
                        
                //         $RefarralPointsTransaction = RefarralPointsTransaction::create([
                //             'client_id' =>  $refarralclientData, 
                //             'referred_by' => $clientData->id,
                //             'refarralpoints' => $request->input('refarralpoints'), 
                //             'status' => 'cr',
                //             'note' => "You have got ".$settings->option_value." points because of a new registration has been done through your referral code.",            
                //         ]);
                        
                //     }
                    
                // }
               
                
               
            }else{
                return response()->json(['message' => 'Faild To Save Data Something Went Wrong!'],422);
            }


            $subject = 'Client Account Created Successfully';
            $content = 'Hi'.$request->input('firstname').', Your client account created successfully. You can login using credentials - Link : https://jobboard.works-reddensoft.com/, Email : '.$request->input('email').' , Password : '.$request->input('password_confirmation').'';
            $recipientEmail = $request->input('email');
    
            // Send email
            Mail::to($recipientEmail)->send(new SendMail($subject, $content));
    


            return response()->json(['message' => 'Account Created Successfully']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
   
   
    // Function for get data of a specific client  
    public function getIndividualClientData(Request $request)
    {       
        $clientData = Clients::where('id', $request->id)->with('user')->get();
        
        return response()->json([
            'message' => 'Success',
            'client_data' => $clientData,
        ],200);            
    }

    // Function for update data of a specific client
    public function updateClientData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|'.Rule::unique('users')->ignore($request->input('id')),
            'phone' => 'required|string',           
        ]);

       if ($validator->fails()) {
            $errors = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errors,
            ];
            return response()->json($response, 400);
        }
        try {
            if($request->input('id')){         
                // Update client data of user table       
                $clientData = User::where('id', $request->input('id'))->update([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                ]);
           
                // Update data of client table           
                Clients::where('user_id', $request->input('id'))->update([
                    'country' => $request->input('country'),
                    'about' => $request->input('about'),
                    'address' => $request->input('address')
                ]);
            }else{
                return response()->json(['message' => 'Faild To Update Data, Something Went Wrong!'],422);
            }

            // return client updated data 
            $clientData = Clients::where('user_id', $request->input('id'))->with('user')->get();
            return response()->json(['message' => 'Client record updated successfully', 'client_data' => $clientData]);

        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }            
    }

    
    // Function for get data of a specific client  
    public function deleteClientData(Request $request)
    {       
        User::where('id', $request->id)->delete();
        Clients::where('user_id', $request->id)->delete();
        
        return response()->json([
            'message' => 'Client Deleted Successfully',
        ],200);            
    }

     // Function for add a new client  
    public function addRefarralTransactionData(Request $request){
                      
        // Insert data into client table if the user id created            
        $RefarralPointsTransaction = RefarralPointsTransaction::create([
            'client_id' =>  $request->input('clientId'), 
            'refarralpoints' => $request->input('refarralpoints'),
            'referred_by' => '1',
            'usertype' => '1',
            'status' => $request->input('status'),
            'note' => $request->input('note'),            
        ]);

        if($RefarralPointsTransaction->id){
            $refarralpoints = $request->input('refarralpoints');
            $selectedUserRefarralPoint = $request->input('selectedUserRefarralPoint');
            if($request->input('status') === 'cr'){
                $totalRefarralPoints = $selectedUserRefarralPoint + $refarralpoints;
            }elseif($request->input('status') === 'dr'){
                $totalRefarralPoints = $selectedUserRefarralPoint - $refarralpoints;
            }

            Clients::where('user_id', $request->input('clientId'))->update([
                'refarralpoints' => $totalRefarralPoints
            ]);
            $RefarralPointsTransactionData = RefarralPointsTransaction::where('client_id', $request->input('clientId'))->orderBy('id', 'DESC')->get();
            return response()->json(['message' => 'Point Updated Successfully', 'refarralTransactionData' => $RefarralPointsTransactionData]);
        }else{
            return response()->json(['message' => 'Faild To Save Data Something Went Wrong!'],422);
        }
    }

    // Get all client list  
    public function getRefarralTransactionData(Request $request)
    {       
        $RefarralPointsTransactionData = RefarralPointsTransaction::where('client_id', $request->id)->orderBy('id', 'DESC')->get();
        $clientData = Clients::where('user_id', $request->id)->with('user')->get();
        return response()->json([
            'message' => 'Success',
            'transaction_data' => $RefarralPointsTransactionData,
            'clientData' =>$clientData
        ],200);                     
    }
    
    // Get invite list  
    public function getInviteList(Request $request)
    {       
        $currentuserid = $request->currentuserid;
        // return $currentuserid;
        $RefarralPointsTransactionData = RefarralPointsTransaction::where('client_id', $currentuserid)->where('usertype', '2')->with('User')->get();
        $RefarralTransactioncount = RefarralPointsTransaction::where('client_id', $currentuserid)->where('usertype', '2')->count();
        
        $result['code'] = '200';
        $result['message'] = 'success';
        // $result['count'] = $RefarralTransactioncount;
        // $result['transaction_data']=$RefarralPointsTransactionData;
        $result['alldata']=[
            'count' => $RefarralTransactioncount,
            'transaction_data' => $RefarralPointsTransactionData,
        ];                     
        return response()->json( $result);
        // return response()->json([
        //     'message' => 'Success',
        //     'transaction_data' => $RefarralPointsTransactionData,
        //     'count' =>$RefarralTransactioncount
        // ],200);                     
    }
    
}
