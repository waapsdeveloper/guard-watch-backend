<?php

namespace App\Services;
use App\Models\Contact;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\ContactResource;
use App\Http\Resources\API\ContactCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ContactService {



    public function __construct()
    {

    }

    public function list($data){

        $user = Auth::user();
        $contacts = Contact::where(['created_by' => $user->id])->get();
        $list = new ContactCollection($contacts);
        return ServiceResponse::success('Contacts List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Contact::where([
            'created_by' => $user->id,
            'dial_code' => $data['dial_code'],
            'phone_number' => $data['phone_number'],
        ])->first();

        if($item){
            return ServiceResponse::error('Contact Already Exist With Phone Number');
        }

        $item = new Contact();
        $item->created_by = $user->id;
        $item->name = $data['name'];
        $item->phone_number = $data['phone_number'];
        $item->dial_code = $data['dial_code'];
        $item->email = $data['email'];
        $item->save();

        $res = new ContactResource($item);

        return ServiceResponse::success('Contacts Add', $res);

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
        $item->email = $data['email'];
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



}
