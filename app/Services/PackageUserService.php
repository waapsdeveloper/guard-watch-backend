<?php

namespace App\Services;

use App\Models\PackageUser;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\PackageUserResource;
use App\Http\Resources\API\PackageUserCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\User;

class PackageUserService
{





    public function add($data){
        $user = Auth::user();

        $package = Package::where(['id' => $obj['package_id']])->first();
        $user = User::where(['id' => $obj['user_id']])->first();


        $item = new PackageUser();
        $item->cost = $data['cost'];
        $item->purchase_date = $data['purchase_date'];
        $item->expiry_date = $data['expiry_date'];
        $item->package_id = $package->id;
        $item->user_id = $user->id;
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
