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














}
