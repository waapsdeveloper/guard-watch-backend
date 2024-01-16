<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PackageUserService;


class PackageUserController extends Controller
{


    protected $service;

    public function __construct(PackageUserService $service){
        $this->service = $service;
    }


    public function add(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'package_id' => 'required|exists:packages,id',
            'user_id' => 'required|exists:users,id',
            'cost' => 'required|integer ',
            'purchase_date' => 'required|date',
            'expiry_date' => 'required|date'

        ]);

        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        // Your existing logic to add the data
        $res = $this->service->add($data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);
    }


}
