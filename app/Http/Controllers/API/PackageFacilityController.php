<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PackageFacilityService;


class PackageFacilityController extends Controller
{


    protected $service;

    public function __construct(PackageFacilityService $service){
        $this->service = $service;
    }

    public function list()
    {
        $res = $this->service->list();

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package List", $res);
    }

    public function add(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'package_id' => 'required|exists:packages,id',
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->add($data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package facilities Added", $res);
    }




    public function edit(Request $request, $id)
    {
        $data = $request->all();

        // Validating the required fields
        $validation = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'picture' => 'required|string',
        ]);

        // If validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->edit($id, $data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package Updated", $res);
    }




    public function delete($id)
    {
        $res = $this->service->delete($id);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package Deleted", $res);
    }






}