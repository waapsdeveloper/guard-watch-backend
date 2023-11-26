<?php

namespace App\Services;
use App\Models\User;
use App\Models\Contact;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\ContactResource;
use App\Http\Resources\API\ContactCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;
use Carbon\Carbon;

class ContactService {



    public function __construct()
    {

    }

    public function contactList($data){

        $user = Auth::user();
        $contacts = Contact::where(['user_id' => $user->id])->get();
        return ServiceResponse::success('Contacts List', $contacts);

    }

    public function contactAdd($data){

        $user = Auth::user();
        // check existing contact
        $contact = Contact::where([
            'user_id' => $user->id,
            'dial_code' => $data['dial_code'],
            'phone_number' => $data['phone_number'],
        ])->first();

        if($contact){
            return ServiceResponse::error('Contact Already Exist With Phone Number');
        }

        $contact = new Contact();
        $contact->user_id = $user->id;
        $contact->name = $data['name'];
        $contact->phone_number = $data['phone_number'];
        $contact->dial_code = $data['dial_code'];
        $contact->email = $data['email'];
        $contact->save();

        $res = new ContactResource($contact);

        return ServiceResponse::success('Contacts Add', $res);

    }

    public function contactEdit($data){

        $user = Auth::user();
        // check existing contact
        $contact = Contact::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$contact){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $contact->name = $data['name'];
        $contact->phone_number = $data['phone_number'];
        $contact->dial_code = $data['dial_code'];
        $contact->email = $data['email'];
        $contact->save();

        $res = new ContactResource($contact);

        return ServiceResponse::success('Contacts Edit', $res);

    }

    public function contactById($data){

        $user = Auth::user();
        // check existing contact
        $contact = Contact::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$contact){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $res = new ContactResource($contact);

        return ServiceResponse::success('Contact One', $res);

    }

    public function contactDelete($data){

        $user = Auth::user();
        // check existing contact
        $contact = Contact::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$contact){
            return ServiceResponse::error('Contact Does not Exist With Phone Number');
        }

        $contact->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Contact Deleted', $res);

    }



}
