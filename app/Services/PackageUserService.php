<?php

namespace App\Services;

use App\Models\PackageUser;
use App\Models\User;
use App\Models\Package;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\PackageUserResource;
use App\Http\Resources\API\PackageUserCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PackageUserService
{





    public function add($data){
        $user = Auth::user();

        $package = Package::where(['id' => $data['package_id']])->first();
        $package = Package::where(['cost' => $data['cost']])->first();
        $package = User::where(['id' => $data['user_id']])->first();


        $item = new PackageUser();
        $item->purchase_date = $data['purchase_date'];
        $item->expiry_date = $data['expiry_date'];
        $item->save();

        $result = new PackageUserResource($item);

        // $result = [
        //     'name' => $item->name,
        //     'phone_number' => $item->phone_number,
        //     'dial_code' => $item->dial_code,
        //     'space_name' => $item->space_name,
        // ];

        return ServiceResponse::success('Package User Add', $result);

    }




}
