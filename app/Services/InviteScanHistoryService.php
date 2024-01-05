<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\InviteScanHistory;
use App\Models\Space;
use App\Models\Invite;
use App\Models\InviteContact;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteScanHistoryResource;
use App\Http\Resources\API\InviteScanHistoryCollection;
use App\Http\Resources\API\InviteContactCollection;
// use App\Http\Resources\API\InviteReceivedCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Http\Resources\API\ContactResource;
use App\Http\Resources\API\UserResource;

// use App\Models\Invite;
use App\Models\User;
use App\Models\Contact;
use App\Controllers\API\InviteScanHistoryController;

class InviteScanHistoryService {



    public function __construct()
    {

    }

    public function list($data){
        // $user = Auth::user();
        // dd($data);
        // return ("heloooooo");
        // $invitehistory = InviteScanHistory::where(['created_by' => $user->id])->get();
        // $list = new InviteScanHistoryCollection($invitehistory);
        // return ServiceResponse::success('Invite scan history List', $list);
    }



    public function add($data){
        dd($data);
        $user = Auth::user();
        // check existing contact

        $item = new Invite();
        $item->invite_id = $data->invite['invite_id'];
        $item->invite_contact_id = $data->invitecontact['invite_contact_id'];
        $item->scan_by_user_id = $data['scan_by_user_id'];
        $item->scan_date_time = $data['scan_date_time'];
        $item->status =$data['status'];
        $item->save();

        $invitehistory = new InviteScanHistoryResource($item);

        // add contacts to invite


        $result = [
            'invite_id' => $invite_id,
            'invite_contact_id' => $invite_contact_id,
            'scan_by_user_id' => $scan_by_user_id,
            'scan_date_time' => $scan_date_time,
            'status' => $status
        ];

        return ServiceResponse::success('Invite scan history Add', $result);

    }


    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Invite Does not Exist');
        }
        $item->description = $data['description'];
        $item->save();

        $res = new InviteResource($item);

        return ServiceResponse::success('Invite Edit', $res);

    }


    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Invite Does not Exist');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Invite Deleted', $res);

    }















}
