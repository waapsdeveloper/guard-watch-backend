<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Package;
use App\Models\User;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\ProfileResource;
use App\Http\Resources\API\ProfileCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileService
{



    public function list()
    {
        $user = Auth::user();

        $item = Profile::get();

        $res = ProfileResource::collection($item);

        return ServiceResponse::success('Profile List', $res);
    }





    public function add($data){
        $user = Auth::user();

        $package = Package::where(['id' => $data['package_id']])->first();
        $user = User::where(['id' => $data['package_id']])->first();


        $item = new Profile();
        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->last_active_hour = $data['last_active_hour'];
        $item->picture = $data['picture'];
        $item->package_id = $package->id;
        $item->user_id = $user->id;
        $item->save();

        $result = new ProfileResource($item);



        return ServiceResponse::success('Profile Added', $result);

    }



    public function edit($id, $data)
    {
        $user = Auth::user();

        $item = Profile::where([
            'id' => $id
        ])->first();

        if (!$item) {
            return ServiceResponse::error('Notification not found');
        }

        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->last_active_hour = $data['last_active_hour'];
        $item->picture = $data['picture'];
        $item->save();

        $res = new ProfileResource($item);

        return ServiceResponse::success('Profile Updated', $res);
    }




    public function delete($id)
    {
        $user = Auth::user();


        $item = Profile::where([
            'id' => $id
        ])->first();

        if (!$item) {
            return ServiceResponse::error('Profile not found');
        }

        // Delete the notification
        $item->delete();

        return ServiceResponse::success('Profile Deleted');
    }












}
