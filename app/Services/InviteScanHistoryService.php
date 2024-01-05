<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\Invite;
use App\Models\Space;
use App\Models\InviteContact;
use App\Helpers\ServiceResponse;
// use App\Http\Resources\API\InviteScanHistoryResource;
use App\Http\Resources\API\InviteScanHistoryCollection;
use App\Http\Resources\API\InviteContactCollection;
use App\Http\Resources\API\InviteReceivedCollection;
// use Illuminate\Support\Facades\Auth;
// use Carbon\Carbon;
use App\Helpers\Helper;
use App\Http\Resources\API\ContactResource;
use App\Http\Resources\API\UserResource;
use Carbon\Carbon;
use App\Models\InviteScanHistory; // Add the correct namespace for your model
use App\Http\Resources\InviteScanHistoryResource; // Add the correct namespace for your resource
use Illuminate\Support\Facades\Auth;
use App\Services\InviteScanHistoryService;
// use App\Models\Invite;
use App\Models\User;
use App\Models\Contact;
use App\Controllers\API\ContactController;

class InviteScanHistoryService {



    public function __construct()
    {

    }

    public function list($data){
        $user = Auth::user();
        $invites = Invite::where(['created_by' => $user->id])->get();
        $list = new InviteScanHistoryCollection($invites);
        return ServiceResponse::success('Invite List', $list);
    }



    public function add($data)
    {
        $user = Auth::user();

        $scanHistory = new InviteScanHistory();
        $scanHistory->invite_id = $data['invite_id'];
        $scanHistory->invite_contact_id = $data['invite_contact_id'];
        $scanHistory->scan_by_user_id = $data['scan_by_user_id'];
        $scanHistory->scan_date_time = Carbon::parse($data['scan_date_time'])->format('Y-m-d H:i:s');
        $scanHistory->status = $data['status'];
        $scanHistory->save();

        $scanHistoryResource = new InviteScanHistoryResource($scanHistory);

        $result = [
            'scan_history' => $scanHistoryResource,
            // add other data if needed
        ];
        dd($result);
        return ServiceResponse::success('Scan History Add', $result);
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