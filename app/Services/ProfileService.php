<?php

namespace App\Services;

use App\Models\Profile;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\ProfileResource;
use App\Http\Resources\API\ProfileCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Space;
use App\Models\User;

class ProfileService
{






    // public function list()
    // {
    //     $user = Auth::user();

    //     // Retrieve the list of packages (adjust the model name accordingly)
    //     $packages = Package::get();

    //     $res = PackageResource::collection($packages);

    //     return ServiceResponse::success('Package List', $res);
    // }



    public function add($data)
    {
        $user = Auth::user();

        // check existing package
        $profiles = Profile::where([
            'title' => $data['title']
        ])->first();

        if ($profiles) {
            return ServiceResponse::error('Profile Already Exists with Title');
        }

        $profiles = new profile();

        $space = space::findOrFail($data['space_id']);

        $user = User::findOrFail($data['user_id']);

        $profiles->title = $data['title'];
        $profiles->description = $data['description'];
        $profiles->last_active_hour = $data['last_active_hour'];
        $profiles->picture = $data['picture'];
        $profiles->save();

        $res = new ProfileResource($profiles);

        return ServiceResponse::success('Profile Added', $res);
    }








    // public function edit($id, $data)
    // {
    //     $user = Auth::user();

    //     // Find the package by ID
    //     $package = Package::where([
    //         'id' => $id
    //     ])->first();

    //     if (!$package) {
    //         return ServiceResponse::error('Package not found');
    //     }

    //     // Update the package
    //     $package->title = $data['title'];
    //     $package->description = $data['description'];
    //     $package->cost = $data['cost'];
    //     $package->picture = $data['picture'];
    //     $package->save();

    //     $res = new PackageResource($package);

    //     return ServiceResponse::success('Package Updated', $res);
    // }



    // public function delete($id)
    // {
    //     $user = Auth::user();

    //     // Find the package by ID
    //     $package = Package::find($id);

    //     if (!$package) {
    //         return ServiceResponse::error('Package not found');
    //     }

    //     // Delete the package
    //     $package->delete();

    //     return ServiceResponse::success('Package Deleted');
    // }









}
