<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use App\Services\InviteService;
// use App\Helpers\Helper;

class InviteScanHistoryController extends Controller
{

    public function add(Request $request)
    {
        $data =$request->all();

        $validation = Validator::make($data,[
            'invite_id' => 'required|int|exists:invites,id',
            'invite_contact_id' => 'required|int|exists:invitecontacts,id',
            'scan_by_user_id' => 'required',
            'scan_date_time' => 'required|datetime',
            'status' => 'required|string'


        ]);
        // dd($validation);
        // return ($validation);
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }
        $res =add($data);
        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);
    }

}
