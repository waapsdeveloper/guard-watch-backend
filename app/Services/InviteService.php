<?php

namespace App\Services;
use App\Http\Resources\API\SpaceResource;
use App\Models\Invite;
use App\Models\Space;
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

    public function getInvitesBySpaceId($data){
        $user = Auth::user();
        $invites = Invite::where(['user_id' => $user->id, 'space_id' => $data['id'] ])->get();
        $list = new InviteCollection($invites);

        $space = new SpaceResource(Space::where(['id' => $data['id']])->first());

        $obj = [
            'space' => $space,
            'invites' => $list
        ];

        return ServiceResponse::success('Invite List', $obj);
    }



}
