<?php

namespace App\Services;

use App\Models\PackageUser;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\PackageUserResource;
use App\Http\Resources\API\PackageUserCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Package;

class PackageUserService
{





    public function add($data){
        $user = Auth::user();

        $package = Package::where(['id' => $data['package_id']])->first();


        $item = new PackageUser();
        $item->name = $data['name'];
        $item->phone_number = $data['phone_number'];
        $item->dial_code = $data['dial_code'];
        $item->comments = $data['comments'];
        $item->date = $data['date'];
        $item->space_id = $space->id;
        $item->space_name = $space->title;
        $item->save();

        $result = new PackageUserResource($item);

        // $result = [
        //     'name' => $item->name,
        //     'phone_number' => $item->phone_number,
        //     'dial_code' => $item->dial_code,
        //     'space_name' => $item->space_name,
        // ];

        return ServiceResponse::success('Invite Request Add', $result);

    }




}
