<?php

namespace App\Services;
use App\Models\InviteRequest;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\InviteRequestResource;
use App\Http\Resources\API\InviteRequestCollection;
use App\Models\Space;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\Helper;

class InviteRequestService {



    public function __construct()
    {

    }

    public function list($data)
    {
        $user = Auth::user();
        $inviteRequests = InviteRequest::get();
        $list = new InviteRequestCollection($inviteRequests);

        return ServiceResponse::success('Invite Requests List', $list);
    }





    public function add($data){
        $user = Auth::user();

        $space = Space::where(['id' => $data['space_id']])->first();


        $item = new InviteRequest();
        $item->name = $data['name'];
        $item->phone_number = $data['phone_number'];
        $item->dial_code = $data['dial_code'];
        $item->comments = $data['comments'];
        $item->date = $data['date'];
        $item->space_id = $space->id;
        $item->space_name = $space->title;
        $item->save();

        $result = new InviteRequestResource($item);

        // $result = [
        //     'name' => $item->name,
        //     'phone_number' => $item->phone_number,
        //     'dial_code' => $item->dial_code,
        //     'space_name' => $item->space_name,
        // ];

        return ServiceResponse::success('Invite Request Add', $result);

    }



    public function getSpaceInvitesById($data){
        $user = Auth::user();
        $inviteRequests = new InviteRequestCollection($inviteRequests);

        $inviteRequests = new InviteRequestResource(InviteRequest::where(['id' => $data['id']])->first());

        $obj = [
            // 'space' => $space,
            // 'invites' => $list,
            'name' =>$inviteRequests,
            'phone_number'=>$inviteRequests,
            'dial_code'=>$inviteRequests,
            'space_id'=>$inviteRequests,
            'space_name'=>$inviteRequests,
            'date'=>$inviteRequests,
            'comments'=>$inviteRequests,
        ];

        return ServiceResponse::success('Invite request List', $obj);
    }



    public function edit($data)
    {
        $user = Auth::user();

        $item = InviteRequest::where([
            'id' => $data['id'],
        ])->first();

        if (!$item) {
            return ServiceResponse::error('Invite Request Does not Exist');
        }

        $item->name = $data['name'];
        $item->phone_number = $data['phone_number'];
        $item->dial_code = $data['dial_code'];
        $item->space_name = $data['space_name'];

        $item->save();

        $res = new InviteRequestResource($item);

        return ServiceResponse::success('Invite Request Edit', $res);
    }







    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = InviteRequest::where([
            'id' => $data['id']
        ])->first();

        if(!$item){
            return ServiceResponse::error('Invite Does not Exist');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Invite Deleted', $res);

    }

















}
