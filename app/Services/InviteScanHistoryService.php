<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\Invite;
use App\Models\Space;
use App\Models\InviteContact;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteScanHistoryResource;
use App\Http\Resources\API\InviteScanHistoryCollection;
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
