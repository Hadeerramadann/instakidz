<?php  

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtLibrary
{
    static $key = "j*ZF=GR5A_fLWkd=#f8v6+q32g8qsU!w";

    public static function encode($user_id, $user_role)
    {
        $inputs = [
            'user_id' => $user_id,
            'user_role' => $user_role,
            // 'iat' => time(), // Issued at
            // 'exp' => time() + 3600 // Expiration time (1 hour)
        ];
        $jwt = JWT::encode($inputs, self::$key, 'HS256');
        return $jwt;
    }

    public static function decode($jwt)
    {
        $decoded = JWT::decode($jwt, new Key(self::$key, 'HS256'));
        return  $decoded; // Convert object to an array
        
    }

    public static function getToken()
    {
        if (!empty(request()->header('token'))) {
            return request()->header('token');
        } elseif (!empty(request()->input('token'))) {
            return request()->input('token');
        }
        return "";
    }
}
