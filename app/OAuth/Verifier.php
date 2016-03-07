<?php
/**
 * Created by PhpStorm.
 * User: w8
 * Date: 03/03/2016
 * Time: 22:56
 */

namespace codeproject\OAuth;

use Auth;

class Verifier
{

    public function verify($username,$password)
    {
        $credential = [
            'email' => $username,
            'password' => $password,
        ];


        if(Auth::once($credential)){

            return Auth::user()->id;
        }

        return false;
    }
}