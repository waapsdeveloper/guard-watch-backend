<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ContactService;

class ContactController extends Controller
{
    //
    protected $contactService;

    public function __construct(ContactService $contactService){
        $this->contactService = $contactService;
    }

    public function contactList(Request $request){

        $data = $request->all();

        //
        $res = $this->contactService->contactList($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

    public function contactById(Request $request, $id){

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
        $res = $this->contactService->contactById($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

    public function contactAdd(Request $request){

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
        $res = $this->contactService->contactAdd($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);


    }

    public function contactEdit(Request $request, $id){

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
        $res = $this->contactService->contactEdit($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);

    }

    public function contactDelete(Request $request, $id){

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
        $res = $this->contactService->contactDelete($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }
}
