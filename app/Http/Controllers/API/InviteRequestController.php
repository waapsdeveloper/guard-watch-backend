<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\InviteRequestService;
use App\Helpers\Helper;

class InviteRequestController extends Controller
{
    //
    //
    protected $service;

    public function __construct(InviteRequestService $service){
        $this->service = $service;
    }

    public function list(Request $request){

        $data = $request->all();


        $res = $this->service->list($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }


    public function add(Request $request)
    {
        $data = $request->all();

        // Validating the required fields (excluding 'qr_code')
        $validation = Validator::make($data, [
            'space_id' => 'required|exists:spaces,id',
            'name' => 'required|string ',
            'phone_number' => 'required|string',
            'dial_code' => 'required|string',
            'comments' => 'required|string',
            'date' => 'required|date',

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






    public function edit(Request $request, $id){

        $data = $request->all();
        $data['id'] = $id;

        // validating the required fields
        $validation = Validator::make($data, [
            'name' => 'required|string ',
            'phone_number' => 'required|string',
            'dial_code' => 'required|string',
            'space_name' => 'required|string'

        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->edit($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);

    }









    public function delete(Request $request, $id){

        $data = $request->all();
        $data['id'] = $id;

        // validating the required fields
        $validation = Validator::make($data, [
            'id' => 'required'
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->delete($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }


}
