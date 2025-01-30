<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register','sendResetLinkEmail','resetPasswordApi']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $expiresAt = now()->addDays(7); 
        $result = array();
       
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token',['*'],$expiresAt)->plainTextToken;  
            $result['code'] = '200';
            $result['status'] = 'success';
            $result['message'] = 'Login Successful';
            $result['user']=$user;
            $result['authorization']=[
                'token' => $token,
                'type' => 'bearer',
                'usertype' => $user->usertype,
            ];                     
            return response()->json( $result);
        }
        
        return response()->json([
            'message' => 'Sorry! Invalid Credentials.',
        ], 401);
        
    }
    


    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'firstname' => $request->name,
            'lastname' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function resetPasswordApi(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required|string',
        ]);

        $response = $this->resrtbroker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET 
                        ? response()->json(['message' => 'Password Reset Successfully. Please Login To Continue.'], 200) 
                        : response()->json(['error' => 'Error Resetting Password'], 400);
    }

    protected function resrtbroker()
    {
        return Password::broker();
    }


    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

       $user=User::where('email', $request->email)->first();
      
    //    http://localhost:5173/reset-password?email=keya@reddensoft.com&token=248a3b4f5c0c6a9b0a50f7d19fe8cbbbc341a53b950b4aa0ae1c641c4c9d2c17

        // Instead of sending an email, generate and return a password reset token
        $token = $this->resrtbroker()->createToken($user);

        if ($token) {

            $subject = 'Reset Password';
            $content = "Hi, We received a request for reset password from your account, Please click On the bellow link to reset your password.".env('APP_SITE_URL').'reset-password?email='.$request->email.'&token='.$token;
            $recipientEmail = $request->input('email');
             // Send email
            Mail::to($recipientEmail)->send(new SendMail($subject, $content));

            return response()->json(['message' => 'Password Reset Link Sent To Your Email', 'token' => $token, 'email'=>$request->email, 'reset_link' => 'ResetPassword',], 200);
        }    
        return response()->json(['error' => 'Error Generating Password Reset Token'], 400);
    }
}