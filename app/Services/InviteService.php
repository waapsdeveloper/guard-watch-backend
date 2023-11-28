<?php

namespace App\Services;
use App\Models\Invite;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteResource;
use App\Http\Resources\API\InviteCollection;
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
        $item = Invite::where([
            'created_by' => $user->id,
            'description' => $data['description']
        ])->first();

        if($item){
            return ServiceResponse::error('Invite Already Exist With title');
        }

        $item = new Invite();
        $item->created_by = $user->id;
        $item->description = $data['description'];
        $item->pass_validity = $data['pass_validity'];
        $item->pass_type = $data['pass_type'];
        $item->visitor_type = $data['visitor_type'];
        $item->space_id = $data['space_id'];
        $item->event_id = $data['event_id'];
        $item->is_quick_pass = $data['is_quick_pass'];
        $item->pass_start_date = $data['pass_start_date'];
        $item->pass_date = $data['pass_date'];
        $item->lat = $data['lat'];
        $item->lng = $data['lng'];
        $item->is_sent_by_sms = $data['is_sent_by_sms'];
        $item->save();

        $res = new InviteResource($item);

        return ServiceResponse::success('Invite Add', $res);

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



}
