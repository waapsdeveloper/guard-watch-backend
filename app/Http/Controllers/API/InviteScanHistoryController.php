<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
// use App\Services\InviteService;
// use App\Helpers\Helper;

class InviteScanHistoryController extends Controller
{


    public function list(Request $request){

        $data = $request->all();

        //
        $res = $data;

        if($res == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }


    public function add(Request $request)
    {
        $data =$request->all();

        $validation = Validator::make($data,[
            'invite_id' => 'required|int|exists:invites,id',
            'invite_contact_id' => 'required|int',
            'scan_by_user_id' => 'required|int',
            'scan_date_time' => 'required|string',
            'status' => 'required|string'


        ]);
        // dd($validation);
        // return ($validation);
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }
        $res =$data;
        if ($res == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);
    }

}
