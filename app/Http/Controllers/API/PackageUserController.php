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


    public function list(Request $request)
    {
        $data = $request->all();
        $res = $this->service->list($data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);
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


    public function edit(Request $request, $id)
{
    $data = $request->all();
    $data['id'] = $id;

    // validating the required fields
    $validation = Validator::make($data, [
        'cost' => 'required|numeric',
        'purchase_date' => 'required|date',
        'expiry_date' => 'required|date',
    ]);

    // if validation failed
    if ($validation->fails()) {
        return self::failure($validation->errors()->first());
    }

    $res = $this->service->edit($data);

    if ($res['bool'] == false) {
        return self::failure($res['message'], $res);
    }

    return self::success("PackageUser Edit Result", $res);
}


public function delete(Request $request, $id)
{
    // Validating the required fields
    $validation = Validator::make(['id' => $id], [
        'id' => 'required',
    ]);

    // If validation fails
    if ($validation->fails()) {
        return self::failure($validation->errors()->first());
    }

    // Data is valid, proceed with deletion
    $res = $this->service->delete($id);

    if ($res['bool'] == false) {
        return self::failure($res['message'], $res);
    }

    return self::success("", $res);
}


}
