<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\Invite;
use App\Models\Space;
use App\Models\InviteContact;
use App\Models\InviteRequest;
use App\Models\InviteScanHistories;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteResource;
use App\Http\Resources\API\InviteCollection;
use App\Http\Resources\API\InviteRequestResource;
use App\Http\Resources\API\InviteRequestCollection;
use App\Http\Resources\API\InviteContactCollection;
use App\Http\Resources\API\InviteReceivedCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Http\Resources\API\ContactResource;
use App\Http\Resources\API\UserResource;

// use App\Models\Invite;
use App\Models\User;
use App\Models\Contact;
use App\Controllers\API\ContactController;

class InviteRequestService {



    public function __construct()
    {

    }

    public function list($data){
        $user = Auth::user();
        $invites = Invite::where(['created_by' => $user->id])->get();
        $list = new InviteCollection($invites);
        return ServiceResponse::success('Invite List', $list);
    }





    public function add($data){
        $user = Auth::user();


        $item = new InviteRequest();
        $item->name = $data['name'];
        $item->phone_number = $data['phone_number'];
        $item->dial_code = $data['dial_code'];
        $item->space_name = $data['space_name'];
        $item->save();









        $result = [
            'item' => $item->$data,
        ];

        return ServiceResponse::success('Invite Request Add', $result);

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
