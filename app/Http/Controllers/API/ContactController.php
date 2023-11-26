<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ContactService;

class ContactController extends Controller
{
    //
    protected $service;

    public function __construct(ContactService $service){
        $this->service = $service;
    }

    public function list(Request $request){

        $data = $request->all();

        //
        $res = $this->service->list($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

    public function byId(Request $request, $id){

        $data = $request->all();
        $data['id'] = $id;

        // validating the required fields
        $validation = Validator::make($data, [
            'id' => 'required|exists:contacts,id'
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->byId($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

    public function add(Request $request){

        $data = $request->all();

        // validating the required fields
        $validation = Validator::make($data, [
            'name' => 'required|string',
            'dial_code' => 'required|string',
            'phone_number' => 'required|min:10',
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->add($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);


    }

    public function edit(Request $request, $id){

        $data = $request->all();
        $data['id'] = $id;

        // validating the required fields
        $validation = Validator::make($data, [
            'id' => 'required|exists:contacts,id',
            'name' => 'required|string',
            'dial_code' => 'required|string',
            'phone_number' => 'required|min:10',
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
            'id' => 'required|exists:contacts,id'
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
