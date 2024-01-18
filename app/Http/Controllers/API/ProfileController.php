<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ProfileService;


class ProfileController extends Controller
{


    protected $service;

    public function __construct(ProfileService $service){
        $this->service = $service;
    }




    public function add(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'user_id' => 'required |exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'last_active_hour' => 'required|date',
            'picture' => 'required|string',
        ]);

        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->add($data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Profile Added", $res);
    }








}
