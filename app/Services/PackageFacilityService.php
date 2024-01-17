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
        $packageFacility = PackageFacility::get();

        $res = PackageFacilityResource::collection($packageFacility);

        return ServiceResponse::success('Package facility List', $res);
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

        $packageFacility = PackageFacility::where([
            'id' => $id
        ])->first();

        if (!$packageFacility) {
            return ServiceResponse::error('Package facilty not found');
        }

        $packageFacility->title = $data['title'];
        $packageFacility->description = $data['description'];
        $packageFacility->save();

        $res = new PackageFacilityResource($packageFacility);

        return ServiceResponse::success('Package facility Updated', $res);
    }



    public function delete($id)
    {
        $user = Auth::user();

        $packageFacility = PackageFacility::find($id);

        if (!$packageFacility) {
            return ServiceResponse::error('Package facility not found');
        }

        // Delete the package
        $packageFacility->delete();

        return ServiceResponse::success('Package facility Deleted');
    }






}
