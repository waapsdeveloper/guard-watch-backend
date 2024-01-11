<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\Invite;
use App\Models\Space;
use App\Models\InviteContact;
use App\Models\InviteScanHistories;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteResource;
use App\Http\Resources\API\InviteCollection;
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

    public function received($data)
    {
        $user = Auth::user();
        $query = InviteContact::query();

        $query->where('phone_number', '=', $user->phone_number);
        $query->where('dial_code', '=', $user->dial_code);

        $query->with(['invite']);

        $result = $query->get();

        $collection = $result->map(function ($item) {

            if ($item->invite) {
                $obj = [
                    "invite_id" => $item->invite_id,
                    "contact_id" => $item->contact_id,
                    "name" => $item->name,
                    "qrcode" => $item->qrcode,
                    "dial_code" => $item->dial_code,
                    "phone_number" => $item->phone_number,
                    "user_id" => $item->invite->user_id,
                    "start_date" => $item->invite->start_date,
                    "end_date" => $item->invite->end_date,
                    "pass_type" => $item->invite->pass_type,
                    "visitor_type" => $item->invite->visitor_type,
                    "comments" => $item->invite->comments
                ];

                return $obj;
            } else {
                return null;
            }

        });

        // Remove null values from the collection
        // $collection = $collection;

        return ServiceResponse::success('Invite List', $collection);
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

            // Generate a random code using the Helper class
            $qr = Helper::generateRandomCode();

            $anv = InviteContact::updateOrCreate([
                'contact_id' => $contact['id'],
                'invite_id' => $item['id']
            ], [
                'name' => $contact['name'],
                'phone_number' => $contact['phone_number'],
                'dial_code' => $contact['dial_code'],
                'qrcode' => $qr
            ]);

            $arr->push($anv);

        }

        $result = [
            'invite' => $invite,
            'invite_contacts' => $arr
        ];

        return ServiceResponse::success('Invite Add', $result);

    }

    public function scanQrcode($data)
    {
        $invite = InviteContact::with(['user', 'contact'])
            ->where('qrcode', $data['qrcode'])
            ->first();

        // Check if $invite exists before accessing its properties
        if (!$invite) {
            return ServiceResponse::error('Scan correctly');
        }

        // Move the code inside the conditional block
        $user = $invite->user;
        // $contact = $invite->contact;
        foreach($contact as $contact){
            [
                'name' => $contact['name'],
                'phone_number' => $contact['phone_number'],
                'dial_code' => $contact['dial_code'],
                'qrcode' => $qr
            ];
            $arr->push($anv);
        }

        // Retrieve scan history data for the current invite
        $scanHistory = InviteScanHistories::get();

        $obj = [
            'invite' => $invite,
            'user' => $user,
            'contact' => $contact,
            'scan_history' => $scanHistory,
            'invite_contacts' => $arr
        ];

        // if ($invite->is_scanned) {
        //     return ServiceResponse::error('Person already scanned', $obj);
        // }

        // // Update the invite as scanned
        // $invite->update(['is_scanned' => 1]);

        return ServiceResponse::success('Person found and scanned', $obj);
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
