<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JWTToken{
    public static function CreateToken($UserEmail,$UserId){
        $key=env('JWT_KEY');
        $payload=[
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp'=>time()+60*60*24*30,
            'UserEmail'=>$UserEmail,
            'UserId'=>$UserId
        ];
        return JWT::encode($payload,$key,'HS256');
    }
    public static function CreateTokenForSetPassword($UserEmail){
        $key=env('JWT_KEY');
        $payload=[
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp'=>time()+60*60*24*30,
            'UserEmail'=>$UserEmail,
            'UserId'=>'0'
        ];
        return JWT::encode($payload,$key,'HS256');
    }
    public static function VerifyToken($token){
        try{
            if($token==null){
                return 'Unauthorized';
            }
            else{
                $key=env('JWT_KEY');
                $decode=JWT::decode($token,new Key($key,'HS256'));
                return $decode;
            }

        }catch(Exception $e){
            return 'Unauthorized';
        }
    }
}
