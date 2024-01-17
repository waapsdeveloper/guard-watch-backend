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

    // public function list()
    // {
    //     $res = $this->service->list();

    //     if ($res['bool'] == false) {
    //         return self::failure($res['message'], $res);
    //     }

    //     return self::success("Package List", $res);
    // }

    public function add(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'space_id' => 'required|exists:spaces,id',
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




    // public function edit(Request $request, $id)
    // {
    //     $data = $request->all();

    //     // Validating the required fields
    //     $validation = Validator::make($data, [
    //         'title' => 'required|string',
    //         'description' => 'required|string',
    //         'cost' => 'required|numeric',
    //         'picture' => 'required|string',
    //     ]);

    //     // If validation failed
    //     if ($validation->fails()) {
    //         return self::failure($validation->errors()->first());
    //     }

    //     $res = $this->service->edit($id, $data);

    //     if ($res['bool'] == false) {
    //         return self::failure($res['message'], $res);
    //     }

    //     return self::success("Package Updated", $res);
    // }




    // public function delete($id)
    // {
    //     $res = $this->service->delete($id);

    //     if ($res['bool'] == false) {
    //         return self::failure($res['message'], $res);
    //     }

    //     return self::success("Package Deleted", $res);
    // }





}
