<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\NotificationService;


class NotificationController extends Controller
{


    protected $service;

    public function __construct(NotificationService $service){
        $this->service = $service;
    }

    public function add(Request $request){

        $data = $request->all();

        // validating the required fields
        $validation = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'expiry' => 'required|date', // Assuming 'expiry' should be a date
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->add($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("Notification Added", $res);
    }





    public function edit(Request $request, $id)
    {
        $data = $request->all();

        // Validating the required fields
        $validation = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'expiry' => 'required|date',
        ]);

        // If validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        $res = $this->service->edit($id, $data);

        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Notification Updated", $res);
    }


}
