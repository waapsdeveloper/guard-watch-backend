<?php

namespace App\Services;
use App\Models\Space;
use App\Models\SpaceAdmin;
use App\Models\Contact;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\SpaceResource;
use App\Http\Resources\API\SpaceCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SpaceService {



    public function __construct()
    {

    }

    public function list($data){

        $user = Auth::user();
        $spaces = Space::where(['created_by' => $user->id])->get();
        $list = new SpaceCollection($spaces);
        return ServiceResponse::success('Spaces List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
            'created_by' => $user->id,
            'title' => $data['title']
        ])->first();

        if($item){
            return ServiceResponse::error('Space Already Exist With title');
        }

        $item = new Space();
        $item->created_by = $user->id;
        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->location = $data['location'];
        $item->save();

        // add a role entry to space admins
        SpaceAdmin::create([
            'user_id' => $user->id,
            'space_id' => $item->id,
            'role_id' => 5,
        ]);

        $res = new SpaceResource($item);
        return ServiceResponse::success('Spaces Add', $res);
    }

    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
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

        $res = new SpaceResource($item);

        return ServiceResponse::success('Spaces Edit', $res);

    }

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist With Phone Number');
        }

        $res = new SpaceResource($item);

        return ServiceResponse::success('Space One', $res);

    }

    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
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

    public function getSpaceDetailsById($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist');
        }

        $inviteCount = $item->invites()->count();

        $item['invite_count'] = $inviteCount;


        // get space details
        return ServiceResponse::success('Space Details', $item);

    }

    public function addSpaceAdmin($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
            'id' => $data['space_id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist');
        }

        // check if user is already a space admin
        $spaceAdmin = SpaceAdmin::updateOrCreate([
            'contact_id' => $data['contact_id'],
            'space_id' => $data['space_id']
        ], [
            'role_id' => 4,
        ]);

        // get space details
        return ServiceResponse::success('Space Details', $item);

    }

    public function deleteSpaceAdmin($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
            'id' => $data['space_id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist');
        }

        // check if user is already a space admin
        $spaceAdmin = SpaceAdmin::where([
            'id' => $data['id']
        ])->delete();

        // get space details
        return ServiceResponse::success('Space Admin Deleted', $data);

    }

    public function getSpaceAdmins($data){

        $user = Auth::user();
        // check existing contact
        $item = Space::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist');
        }

        // check if user is already a space admin
        $spaceAdmins = SpaceAdmin::where(['space_id' => $data['id']])->get();
        $arr = collect([]);

        foreach($spaceAdmins as $item){
            $contact = Contact::where(['id' => $item['contact_id']])->first();
            if($contact){
                $arr->push($contact);
            }
        }

        // get space details
        return ServiceResponse::success('Space Admins', $arr);

    }

    public function getGlobalSpaces(){

        $user = Auth::user();
        $spaces = Space::all();
        $list = new SpaceCollection($spaces);
        return ServiceResponse::success('Spaces List', $list);

    }



}
