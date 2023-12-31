<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\InviteService;

class InvitesController extends Controller
{
    //
    //
    protected $service;

    public function __construct(InviteService $service){
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
            'id' => 'required|exists:invites,id'
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
            'space_id' => 'required|int|exists:spaces,id',
            'contacts' => 'required|array',
            'end_date' => 'required|string',
            'start_date' => 'required|string',
            'event_id' => 'required|int|exists:events,id',
            'pass_type' => 'required|string',
            'validity' => 'required|int',
            'visitor_type' => 'required|string',
            'comments' => 'required|string',
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
            'id' => 'required|exists:invites,id',

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
            'id' => 'required|exists:invites,id'
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

    public function getInvitesBySpaceId(Request $request, $id){

        $data = $request->all();
        $data['id'] = $id;

        // validating the required fields
        $validation = Validator::make($data, [
            'id' => 'required|exists:spaces,id'
        ]);

        // if validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        //
        $res = $this->service->getInvitesBySpaceId($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

}
