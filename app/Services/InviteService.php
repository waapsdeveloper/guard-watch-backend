<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\Invite;
use App\Models\Space;
use App\Models\InviteContact;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteResource;
use App\Http\Resources\API\InviteCollection;
use App\Http\Resources\API\InviteContactCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class InviteService {



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
        $item->space_id = $data['space_id'];
        $item->user_id = $user->id;
        $item->event_id = $data['event_id'];
        $item->end_date = Carbon::parse($data['end_date'])->format('Y-m-d H:i:s');
        $item->start_date = Carbon::parse($data['start_date'])->format('Y-m-d H:i:s');
        $item->pass_type = $data['pass_type'];
        $item->visitor_type = $data['visitor_type'];
        $item->validity = $data['validity'];
        $item->comments = $data['comments'];
        $item->save();

        $invite = new InviteResource($item);

        // add contacts to invite

        $contacts = $data['contacts'];


        $arr = collect([]);
        foreach($contacts as $contact){

            $anv = InviteContact::updateOrCreate([
                'contact_id' => $contact['id'],
                'invite_id' => $item['id']
            ], [
                'name' => $contact['name'],
                'phone_number' => $contact['phone_number'],
                'dial_code' => $contact['dial_code'],
            ]);

            $arr->push($anv);

        }

        $result = [
            'invite' => $invite,
            'invite_contacts' => $arr
        ];

        return ServiceResponse::success('Invite Add', $result);

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

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Invite Does not Exist');
        }

        $res = new InviteResource($item);

        return ServiceResponse::success('Contact One', $res);

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
        InviteContact::whereIn(['id' => $ids])->delete();

        return ServiceResponse::success('Invite Contacts Deleted', $ids);


    }



}
