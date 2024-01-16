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

    public function list()
    {
        $res = $this->service->list();

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package User List", $res);
    }

    public function add(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'package_id' => 'required|exists:packages,id',
            'user_id' => 'required|exists:users,id',
            'cost' => 'required|numeric',
            'purchase_date' => 'required|date',
            'expiry_date' => 'required|date',
        ]);

        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->add($data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("PackageUser Added", $res);
    }





    public function edit(Request $request, $id)
    {
        $data = $request->all();

        // Validating the required fields
        $validation = Validator::make($data, [
            'cost' => 'required|numeric',
            'purchase_date' => 'required|date',
            'expiry_date' => 'required|date',
        ]);

        // If validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->edit($id, $data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("PackageUser Updated", $res);
    }





    public function delete($id)
    {
        $result = $this->service->delete($id);

        if ($result['success']) {
            return self::success("PackageUser Deleted", $result['data']);
        } else {
            return self::failure($result['message'], $result['data']);
        }
    }






}
