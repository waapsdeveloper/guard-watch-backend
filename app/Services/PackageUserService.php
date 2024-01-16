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

            $package = Package::findOrFail($data['package_id'],['cost']);
            // $package = Package::findOrFail($data['cost']);
            $user = User::findOrFail($data['user_id']);
            // $item->cost = $data['cost'];

            $item = new PackageUser();
            $item->purchase_date = carbon::now();
            $item->expiry_date = carbon::now()+ day(30);

            // Assigning the related models directly
            $item->package()->associate($package);
            $item->user()->associate($user);

            $item->save();

            $result = new PackageUserResource($item);

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
