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

        // check existing package
        $Packagefacilities = PackageFacility::where([
            'title' => $data['title']
        ])->first();

        if ($Packagefacilities) {
            return ServiceResponse::error('Package facility Already Exists with Title');
        }
        $package = Package::findOrFail($data['package_id']);

        $Packagefacilities = new PackageFacility();

        $Packagefacilities->title = $data['title'];
        $Packagefacilities->description = $data['description'];

        $Packagefacilities->save();

        $res = new PackageFacilityResource($Packagefacilities);

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