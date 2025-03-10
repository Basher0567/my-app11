<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token=$request->cookie('token');
        $result=JWTToken::VerifyToken($token);
        if($result==="Unauthorized"){
            return response()->json([
                'message'=>'Unauthorized'
            ],401);
        }
        else{
            $request->headers->set('email',$result->UserEmail);
            $request->headers->set('id',$result->UserId);
            return $next($request);
        }
    }
}
