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
        $spaces = Invite::where(['created_by' => $user->id])->get();
        $list = new InviteCollection($spaces);
        return ServiceResponse::success('Spaces List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'created_by' => $user->id,
            'title' => $data['title']
        ])->first();

        if($item){
            return ServiceResponse::error('Space Already Exist With title');
        }

        $item = new Invite();
        $item->created_by = $user->id;
        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->location = $data['location'];
        $item->save();

        $res = new InviteResource($item);

        return ServiceResponse::success('Spaces Add', $res);

    }

    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist');
        }

        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->location = $data['location'];
        $item->save();

        $res = new InviteResource($item);

        return ServiceResponse::success('Spaces Edit', $res);

    }

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Invite::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
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
            return ServiceResponse::error('Space Does not Exist');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Space Deleted', $res);

    }



}
