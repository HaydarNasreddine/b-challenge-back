<?php

namespace App\Http\Controllers;

use App\Helpers\HTTPResponse;
use App\Http\Requests\UserAverageRequest;
use App\Http\Requests\UserFilterRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;

class UserController extends Controller
{
    //
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserRegisterRequest $request)
    {
        $data = $this->userService->create($request->validated());
        return HTTPResponse::ok($data);
    }

    public function login(UserLoginRequest $request)
    {
        $data = $this->userService->login($request->validated());
        return HTTPResponse::ok($data);
    }

    public function logout(Request $request)
    {
        $this->userService->logout($request);
        return HTTPResponse::ok();
    }

    public function getAll()
    {
       $data = $this->userService->getAll();
       return HTTPResponse::ok($data);
    }

    public function filter(UserFilterRequest $request)
    {
        $data = $this->userService->filter($request->validated());
        return HTTPResponse::ok($data);
    }

    public function average(UserAverageRequest $request)
    {
        $data = $this->userService->average($request->validated());
        return HTTPResponse::ok($data);
    }
}


