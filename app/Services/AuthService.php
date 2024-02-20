<?php

namespace App\Services;
use App\Models\User;
use App\Models\UserCode;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;
use Carbon\Carbon;
use App\Models\SpaceAdmin;

class AuthService {



    public function __construct()
    {

    }

    public function getAuthUser(){

        $user = Auth::user();
        return ServiceResponse::success('User', $user);

    }

    // user signup
    public function userSignup($data)
    {

        $user = User::where([ 'phone_number' => $data['phone_number'], 'dial_code' => $data['dial_code'] ])->first();
        if($user){
            return ServiceResponse::error('User Already Exist With Phone Number');
        }

        $user = new User();
        $user->name = $data['name'];
        $user->phone_number = $data['phone_number'];
        $user->dial_code = $data['dial_code'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role_id = 2;
        $user->save();

        $res = new UserResource($user);

        return ServiceResponse::success('User', $res);

    }

    public function userLogin($data)
    {

        $user = User::where([ 'phone_number' => $data['phone_number'], 'dial_code' => $data['dial_code'] ])->first();
        if(!$user){
            return ServiceResponse::error('User Does Not Already Exist With Phone Number');
        }

        $authAttempt = Auth::attempt([
            'phone_number' => $data['phone_number'],
            'password' => $data['password'],
        ]);

        if (!$authAttempt) {
            return ServiceResponse::error('Error: Authentication failed. Please check your phone number or password');
        }

        $user = Auth::user();
        $token = $user->createToken('ZUUL Systems')->accessToken;
        $res = collect(new UserResource($user));

        $res['token'] = $token;

        // check if user is a guard of any space
        $gspaces = SpaceAdmin::where(['user_id' => $user->id])->get();
        $res['guard_spaces'] = $gspaces;

        return ServiceResponse::success('User', $res);

    }

    public function userForget($data){

        $user = User::where(['email' => $data['email'] ])->first();
        if(!$user){
            return ServiceResponse::error('User Does Not Exist With Email');
        }

        // create a code for user in database
        //
        $obj = [
            'code' => random_int(1000, 9999),
            'expire_at' => Carbon::now()->addMinutes(5)
        ];

        $code = UserCode::updateOrCreate([
            'user_id' => $user->id,
        ],$obj);

        $data = [
            'name' => "abc",
            'action_url' => "",
            'support_url' => "",
        ];
        //
        Mail::to('testreceiver@gmail.com’')->send(new ForgetPassword($data));


        return ServiceResponse::success('Email send successfully',  $obj);

    }

    public function verifyUserForget($data){

        $user = User::where(['email' => $data['email'] ])->first();
        if(!$user){
            return ServiceResponse::error('User Does Not Exist With Email');
        }

        $coder = UserCode::where(['user_id' => $user->id, 'code' => $data['code'] ])->first();
        if(!$coder){
            return ServiceResponse::error('Code Does Not Exist With Email');
        }

        if(Carbon::parse($coder->expire_at)->isPast()){
            return ServiceResponse::error('Code Expired With Email, please generate new code');
        }

        $coder->delete();
        $user->update([
            'password' => bcrypt($data['password'])
        ]);

        return ServiceResponse::success('Password updated successfully',  []);

    }

    public function checkIfUserExist($idal_code, $phone_number){


        $user = User::where(['phone_number' => $phone_number, 'dial_code' => $idal_code])->first();
        return $user;


    }

    public function createUserIfNotExistViaModerators($data){

        $user = User::where([ 'phone_number' => $data['phone_number'], 'dial_code' => $data['dial_code'] ])->first();
        if($user){
            return $res = new UserResource($user);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->phone_number = $data['phone_number'];
        $user->dial_code = $data['dial_code'];
        $user->role_id = 2;
        $user->save();

        $res = new UserResource($user);

        return $res;

    }


}
