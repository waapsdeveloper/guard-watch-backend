<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service){
        $this->service = $service;
    }

    //
    public function register(Request $request){

        $data = $request->all();

        // validating the required fields
        $validation = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:10',
            'password' => 'required|string',
            'dial_code' => 'required|string'
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->userSignup($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

    public function login(Request $request){


        $data = $request->all();

        // validating the required fields
        $validation = Validator::make($data, [
            'phone_number' => 'required|min:10',
            'dial_code' => 'required|string',
            'password' => 'required|string'
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->userLogin($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);

    }

    public function forgetPassword(Request $request){

        $data = $request->all();

        // validating the required fields
        $validation = Validator::make($data, [
            'email' => 'required|email'
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->userForget($data);

        return self::success("Email send Successfully", $res);

    }

    public function verifyForgetPassword(Request $request){

        $data = $request->all();

        // validating the required fields
        $validation = Validator::make($data, [
            'email' => 'required|email',
            'code' => 'required',
            'password' => 'required',
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->verifyUserForget($data);

        return self::success("Email send Successfully", $res);

    }

}
