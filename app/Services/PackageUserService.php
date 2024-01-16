<?php

namespace App\Services;

use App\Models\PackageUser;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\PackageUserResource;
use App\Http\Resources\API\PackageUserCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PackageUserService
{






    public function list()
    {
        $user = Auth::user();

        // Retrieve the list of package users
        $packageUsers = PackageUser::where('user_id', $user->id)->get();

        // Transform the data using the PackageUserResource
        $res = PackageUserResource::collection($packageUsers);

        return ServiceResponse::success('Package User List', $res);
    }



    public function add($data)
    {
        // You can add additional validation logic if needed

        $user = Auth::user();

        // Assuming PackageUser model is named PackageUser
        $existingPackageUser = PackageUser::where([
            'package_id' => $data['package_id'],
            'user_id' => $data['user_id'],
        ])->first();

        if ($existingPackageUser) {
            return ServiceResponse::error('PackageUser Already Exists for this Package and User');
        }

        $packageUser = new PackageUser();
        $packageUser->package_id = $data['package_id'];
        $packageUser->user_id = $data['user_id'];
        $packageUser->cost = $data['cost'];
        $packageUser->purchase_date = $data['purchase_date'];
        $packageUser->expiry_date = $data['expiry_date'];
        $packageUser->save();

        $res = new PackageUserResource($packageUser); // Assuming you have a PackageUserResource class

        return ServiceResponse::success('PackageUser Added', $res);
    }



    public function edit($id, $data)
    {
        $user = Auth::user();

        // Find the PackageUser by ID
        $packageUser = PackageUser::find($id);

        if (!$packageUser) {
            return ServiceResponse::error('PackageUser not found');
        }
        $packageUser->cost = $data['cost'];
        $packageUser->purchase_date = $data['purchase_date'];
        $packageUser->expiry_date = $data['expiry_date'];
        $packageUser->save();

        $res = new PackageUserResource($packageUser);

        return ServiceResponse::success('PackageUser Updated', $res);
    }






    public function delete($id)
    {
        $user = Auth::user();

        // Find the PackageUser by ID
        $packageUser = PackageUser::find($id);

        if (!$packageUser) {
            return ServiceResponse::error('PackageUser not found');
        }

        $packageUser->delete();

        return ServiceResponse::success('PackageUser Deleted');
    }




}
