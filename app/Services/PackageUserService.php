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

        // Retrieve the list of packages (adjust the model name accordingly)
        $packages = Package::get();

        $res = PackageResource::collection($packages);

        return ServiceResponse::success('Package List', $res);
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

        // Find the package by ID
        $package = Package::where([
            'id' => $id
        ])->first();

        if (!$package) {
            return ServiceResponse::error('Package not found');
        }

        // Update the package
        $package->title = $data['title'];
        $package->description = $data['description'];
        $package->cost = $data['cost'];
        $package->picture = $data['picture'];
        $package->save();

        $res = new PackageResource($package);

        return ServiceResponse::success('Package Updated', $res);
    }



    public function delete($id)
    {
        $user = Auth::user();

        // Find the package by ID
        $package = Package::find($id);

        if (!$package) {
            return ServiceResponse::error('Package not found');
        }

        // Delete the package
        $package->delete();

        return ServiceResponse::success('Package Deleted');
    }




}
