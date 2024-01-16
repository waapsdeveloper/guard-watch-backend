<?php

namespace App\Services;

use App\Models\Package;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\PackageResource;
use App\Http\Resources\API\PackageCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PackageService
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
        $user = Auth::user();

        // check existing package
        $existingPackage = Package::where([
            'title' => $data['title']
        ])->first();

        if ($existingPackage) {
            return ServiceResponse::error('Package Already Exists with Title');
        }

        $package = new Package();
        $package->title = $data['title'];
        $package->description = $data['description'];
        $package->cost = $data['cost'];
        $package->picture = $data['picture'];
        $package->save();

        $res = new PackageResource($package);

        return ServiceResponse::success('Package Added', $res);
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

        $packageUser = PackageUser::find($id);

        if (!$packageUser) {
            return ServiceResponse::error('PackageUser not found');
        }

        $packageUser->delete();

        return ServiceResponse::success('PackageUser Deleted');
    }




}
