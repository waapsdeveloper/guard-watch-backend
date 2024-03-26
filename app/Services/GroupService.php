<?php

namespace App\Services;
use App\Models\Contact;
use App\Models\Group;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\ContactResource;
use App\Http\Resources\API\ContactCollection;
use App\Http\Resources\API\GroupResource;
use App\Http\Resources\API\GroupCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GroupService {



    public function __construct()
    {

    }

    public function list($data){

        $user = Auth::user();
        $contacts = Group::where(['created_by' => $user->id])->get();
        $list = new GroupCollection($contacts);
        return ServiceResponse::success('Groups List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Group::where([
            'created_by' => $user->id,
            'title' => $data['title'],
        ])->first();

        if($item){
            return ServiceResponse::error('Group Already Exist With title');
        }

        $item = new Group();
        $item->created_by = $user->id;
        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->save();

        $res = new GroupResource($item);

        return ServiceResponse::success('Group Add', $res);

    }

    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Contact::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $item->name = $data['name'];
        $item->phone_number = $data['phone_number'];
        $item->dial_code = $data['dial_code'];
        $item->save();

        $res = new ContactResource($item);

        return ServiceResponse::success('Contacts Edit', $res);

    }

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Contact::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $res = new ContactResource($item);

        return ServiceResponse::success('Contact One', $res);

    }

    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = Contact::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Contact Deleted', $res);

    }

    public function addToFav($data){

        $user = Auth::user();
        // check existing contact
        $item = Contact::where([
            'id' => $data['contact_id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $item->update([
            'is_fav' => $data['is_fav'] == 1 ? 1 : 0
        ]);

        $res = ['id' => $data['contact_id']];

        return ServiceResponse::success('Contact Updated', $res);

    }



    public function getContactByContactId($id){

        $item = Contact::where([
            'id' => $id,
        ])->first();

        if(!$item){
            return null;
        }

        $res = new ContactResource($item);
        return $res;
    }



}
