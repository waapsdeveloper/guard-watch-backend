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

        // Check if the 'package_id' is present in the data
        if (!isset($data['package_id'])) {
            return ServiceResponse::error('Package ID is required.');
        }

        // Check if the package with the given 'package_id' exists
        $package = Package::findOrFail($data['package_id']);

        // Check existing package facility with the same title
        $existingFacility = PackageFacility::where([
            'title' => $data['title'],
            'package_id' => $data['package_id'], // Also check for the package_id
        ])->first();

        if ($existingFacility) {
            return ServiceResponse::error('Package Facility Already Exists with Title');
        }

        // Create a new PackageFacility
        $packageFacility = new PackageFacility();
        $packageFacility->title = $data['title'];
        $packageFacility->description = $data['description'];

        // Associate the Package with the PackageFacility
        $packageFacility->package()->associate($package);

        $packageFacility->save();

        // Use the PackageFacilityResource to transform the result
        $res = new PackageFacilityResource($packageFacility);

        return ServiceResponse::success('Package Added', $res);
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
