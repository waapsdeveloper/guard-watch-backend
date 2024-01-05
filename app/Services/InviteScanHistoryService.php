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
use App\Controllers\API\ContactController;

class InviteScanHistoryService {



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






    public function getScanQrcodeWithContacts($data){
        // dd($data);
        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Invite Does not Exist');
        }

        $invite = new InviteResource($item);
        $list = InviteContact::where(['invite_id' => $item['id']])->with(['user', 'space', 'event'])->get();
        $contacts = new InviteContactCollection($list);

        $obj =[
            'invite' => $invite,
            'contacts' => $contacts
        ];


        return ServiceResponse::success('Invite with Contacts', $obj);

    }





    public function getInviteWithContacts($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Invite Does not Exist');
        }

        $invite = new InviteResource($item);
        $list = InviteContact::where(['invite_id' => $item['id']])->get();
        $contacts = new InviteContactCollection($list);

        $obj =[
            'invite' => $invite,
            'contacts' => $contacts
        ];


        return ServiceResponse::success('Invite with Contacts', $obj);

    }




    public function getInvitesBySpaceId($data){
        $user = Auth::user();
        $invites = Invite::where(['user_id' => $user->id, 'space_id' => $data['id'] ])->with(['user', 'space', 'event'])->get();
        $list = new InviteCollection($invites);

        $space = new SpaceResource(Space::where(['id' => $data['id']])->first());

        $obj = [
            'space' => $space,
            'invites' => $list
        ];

        return ServiceResponse::success('Invite List', $obj);
    }

    public function inviteContactsDelete($arr){

        $deleted = collect([]);

        foreach($arr as $item){
            $ivt = InviteContact::where([
                'invite_id' => $item['invite_id'],
                'contact_id' => $item['contact_id'],
            ])->first();

            if($ivt){
                $deleted->push($ivt->id);
            }

        }

        $ids = $deleted->toArray();
        InviteContact::whereIn('id',$ids)->delete();

        return ServiceResponse::success('Invite Contacts Deleted', $ids);


    }



}
