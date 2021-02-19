<?php

namespace App\Services;

class TokenService 
{
    public function create($user) {
        return $user->createToken('Laravel Password Grant Client')->accessToken;
    }

    public function getToken($request) {
        return $request->user()->token();
    }

}