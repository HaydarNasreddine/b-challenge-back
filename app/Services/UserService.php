<?php

namespace App\Services;

use App\Constants\Average;
use App\Repositories\UserRepo;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    //
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function create($request)
    {

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = $this->userRepo->create($request);
        return $user;
    }

    public function login($request)
    {
        $user = $this->userRepo->findByEmail($request['email']);

        if ($user)
            if (Hash::check($request['password'], $user->password)) {
                $token = (new TokenService())->create($user);
                return ['token' => $token];
            }

        throw new AuthenticationException('Wrong Credentials');
    }

    public function logout($request)
    {
        $token = (new TokenService())->getToken($request);
        $token->revoke();
    }

    public function getAll()
    {
        return $this->userRepo->all();
    }

    public function filter($request)
    {
        return $this->userRepo->filter($request);
    }

    public function average($request)
    {
        if(isset($request['option']))
        return $this->userRepo->average($request['option']);
        else {
            return [
                'last24Hours' => $this->userRepo->average(Average::LAST_24_HOURS),
                'lastWeek' => $this->userRepo->average(Average::LAST_WEEK),
                'lastMonth' => $this->userRepo->average(Average::LAST_MONTH),
                'last3Months' => $this->userRepo->average(Average::LAST_3_MONTHS),
                'lastYear' => $this->userRepo->average(Average::LAST_YEAR),
            ];
        }
    }

    public function addRole($user, $role)
    {
        return $this->userRepo->addRole($user, $role);
    }

    // public function checkVat($vat) {

    //     $result = validateVat($vat);
    //     if(!$result) throw new GlobalException(['key' => Exptions::WRONG_CREDENTIALS]);

    // }
}
