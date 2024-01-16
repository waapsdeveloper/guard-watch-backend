<?php

namespace App\Services;

use App\Models\PackageFacility;
use App\Models\Package;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\PackageFacilityResource;
use App\Http\Resources\API\PackageFacilityCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PackageFacilityService
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
        $user = Auth::user();

        if (!isset($data['package_id'])) {
            return ServiceResponse::error('Package ID is required.');
        }

        $package = Package::findOrFail($data['package_id']);

        $existingFacility = PackageFacility::where([
            'title' => $data['title'],
            'package_id' => $data['package_id'],
        ])->first();

        if ($existingFacility) {
            return ServiceResponse::error('Package Facility Already Exists with Title');
        }

        $packageFacility = new PackageFacility();
        $packageFacility->title = $data['title'];
        $packageFacility->description = $data['description'];



        $packageFacility->package()->associate($package);

        $packageFacility->save();



        $res = new PackageFacilityResource($packageFacility);

        return ServiceResponse::success('Package Added', $res);
    }









    public function edit($id, $data)
    {
        $user = Auth::user();

        // Find the package by ID
        $packageFacility = PackageFacility::where([
            'id' => $id
        ])->first();

        if (!$package) {
            return ServiceResponse::error('Package facilty not found');
        }

        // Update the package
        $packageFacility->title = $data['title'];
        $packageFacility->description = $data['description'];
        $packageFacility->save();

        $res = new PackageFacilityResource($packageFacility);

        return ServiceResponse::success('Package facility Updated', $res);
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
