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
            $packageUsers = PackageUser::all();
            $collection = new PackageUserCollection($packageUsers);

            return ServiceResponse::success('Package Users List', $collection);
        }



        public function add($data)
        {
            $user = Auth::user();

            // Check if 'package_id' and 'cost' keys exist in the $data array
            if (!isset($data['package_id']) || !isset($data['cost'])) {
                return ServiceResponse::error('Invalid data. Missing package_id or cost.');
            }

            // Find the package using the specified ID and retrieve its 'cost' attribute
            $package = Package::findOrFail($data['package_id'], ['cost']);

            // Find the user using the specified ID
            $user = User::findOrFail($data['user_id']);

            // Create a new PackageUser instance
            $item = new PackageUser();

            // Set purchase_date to the current date and expiry_date to 30 days from now
            $item->purchase_date = Carbon::now();
            $item->expiry_date = Carbon::now()->addDays(30);

            // Associate the Package and User models with the PackageUser instance
            $item->package()->associate($package);
            $item->user()->associate($user);

            // Save the PackageUser instance
            $item->save();

            // Create a PackageUserResource instance for the response
            $result = new PackageUserResource($item);

            // Return a success response with a message and the result data
            return ServiceResponse::success('Invite Request Added', $result);
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
