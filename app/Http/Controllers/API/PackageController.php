<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PackageService;


class PackageController extends Controller
{


    protected $service;

    public function __construct(PackageService $service){
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
            'title' => 'required|string',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'picture' => 'required|string',
        ]);

        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->add($data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package Added", $res);
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



    public function myBoughtPackage(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;

        // Validating the required fields
        $validation = Validator::make($data, [
            'id' => 'required|exists:packages,id',
        ]);

        // If validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        // Call the service method to get package details and associated users
        $res = $this->service->myBoughtPackage($data); // Pass the entire $data array

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Package and Package Users", $res['data']);
    }



}
