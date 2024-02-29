<?php

namespace App\Services;
use App\Models\Space;
use App\Models\SpaceAdmin;
use App\Models\Contact;
use App\Models\Role;
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
            'title' => $data['title'],
            'type' => $data['type']
        ])->first();

        if($item){
            return ServiceResponse::error('Space Already Exist With title');
        }

        $item = new Space();
        $item->created_by = $user->id;
        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->type = $data['type'];
        $item->location = $data['location'];
        $item->save();

        // add a role entry to space admins
        // dd($item);
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
        $item->type = $data['type'];
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



        // check if user exist - else create it

        $contactService = new ContactService();
        $contact = $contactService->getContactByContactId($data['contact_id']);

        if(!$contact){
            return ServiceResponse::error('Contact Does not Exist');
        }

        $authService = new AuthService();
        $user = $authService->checkIfUserExist($contact['dial_code'], $contact['phone_number']);
        if(!$user){
            // call create user
            $user = $authService->createUserIfNotExistViaModerators($contact);
        }

        // check if user is already a space admin
        $spaceAdmin = SpaceAdmin::updateOrCreate([
            'contact_id' => $data['contact_id'],
            'space_id' => $data['space_id'],
        ], [
            'role_id' => $data['role_id'],
            'user_id' => $user['id'],
        ]);

        // check if user is already a space admin
        $spaceAdmins = SpaceAdmin::where(['id' => $spaceAdmin['id']])->with(['contact', 'role'])->get();



        // get space details
        return ServiceResponse::success('Space Details', $spaceAdmins);

    }

    public function deleteSpaceAdmin($data){

        $user = Auth::user();
        // check existing contact
        $item = SpaceAdmin::where([
            'id' => $data['id'],
        ])->first();

        if(!$item){
            return ServiceResponse::error('Space Does not Exist');
        }

        // check if user is already a space admin
        $item->delete();

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
        $spaceAdmins = SpaceAdmin::where(['space_id' => $data['id']])->with(['contact', 'role'])->get();

        // get space details
        return ServiceResponse::success('Space Admins', $spaceAdmins);

    }

    public function getGlobalSpaces(){

        $user = Auth::user();
        $spaces = Space::all();
        $list = new SpaceCollection($spaces);
        return ServiceResponse::success('Spaces List', $list);

    }

    public function getSpaceRoles(){

        $list = Role::whereIn('id', [4,5,6])->get()->map(function($item, $key) {
            $obj = [
                'id' => $item['id'],
                'name' => $item['display_name'],
                'slug' => $item['name'],
            ];
            return $obj;
         });
        return ServiceResponse::success('Spaces List', $list);

    }

    public function getMyModerationSpacesByUserId(){

        $user = Auth::user();

        // check if user is already a space admin
        $spaceAdmins = SpaceAdmin::where(['user_id' => $user['id']])->with(['space', 'contact', 'role'])->get();

        // get space details
        return ServiceResponse::success('Space Admins', $spaceAdmins);

    }

    public function getCheckerSpaces($data){



    }



}
