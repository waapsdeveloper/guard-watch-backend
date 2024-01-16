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

    public function list($data)
    {
        $user = Auth::user();
        $packageUsers = PackageUser::all(); // You may adjust this query based on your specific requirements
        $collection = new PackageUserCollection($packageUsers); // Assuming you have a collection class

        return ServiceResponse::success('Package Users List', $collection);
    }



    public function add($data){
        $user = Auth::user();

        $package = Package::where(['id' => $data['package_id']])->first();
        $user = User::where(['id' => $data['user_id']])->first();


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


    public function edit($data)
    {
        $user = Auth::user();

        $packageUser = PackageUser::find($data['id']);

        if (!$packageUser) {
            return ServiceResponse::error('PackageUser Does not Exist');
        }


        $packageUser->cost = $data['cost'];
        $packageUser->purchase_date = $data['purchase_date'];
        $packageUser->expiry_date = $data['expiry_date'];

        $packageUser->save();

        $res = new PackageUserResource($packageUser);

        return ServiceResponse::success('PackageUser Edit', $res);
    }



    public function delete($id)
    {
        $user = Auth::user();

        // Check if the PackageUser exists
        $item = PackageUser::find($id);

        if (!$item) {
            return ServiceResponse::error('PackageUser Does not Exist');
        }

        $item->delete();

        $res = ['id' => $id];

        return ServiceResponse::success('PackageUser Deleted', $res);
    }

}
