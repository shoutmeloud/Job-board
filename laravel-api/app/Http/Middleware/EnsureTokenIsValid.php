<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');
        $hashedToken = $request->bearerToken();       

        if ($hashedToken) {
            $token = PersonalAccessToken::findToken($hashedToken);

            //return response()->json(array('details'=>$token,'nowtime'=>Carbon::now()));
            if ($token) {
                if (Carbon::parse($token->expires_at) > Carbon::now()) {
                    Auth::loginUsingId($token->tokenable_id);
                    $request['currentuserid'] = $token->tokenable_id;
                    $request['authuser'] = Auth::user();
                    return $next($request);
                   // return response()->json(Carbon::parse($token->expires_at));
                } else {

                    $result['code'] = '401';
                    $result['status'] = 'error';
                    $result['message'] = 'Sorry! your AccessToken expire';
                    return response()->json($result);
                }
            } else {
                $result['code'] = '401';
                $result['status'] = 'error';
                $result['message'] = 'Sorry! invalid AccessToken.';
                return response()->json($result);
            }
        } else {
            $result['code'] = '401';
            $result['status'] = 'error';
            $result['message'] = 'You are not valid user.';
            return response()->json($result);
        }

        exit;
    }
}
