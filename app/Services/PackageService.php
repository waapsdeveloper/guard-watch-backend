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

        // Retrieve the list of notifications for the authenticated user
        $notifications = Notification::get();

        $res = NotificationResource::collection($notifications);

        return ServiceResponse::success('Notification List', $res);
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

        // Find the notification by ID
        $notification = Notification::where([
            'id' => $id
        ])->first();

        if (!$notification) {
            return ServiceResponse::error('Notification not found');
        }

        // Update the notification
        $notification->title = $data['title'];
        $notification->description = $data['description'];
        $notification->type = $data['type'];
        $notification->expiry = $data['expiry'];
        $notification->save();

        $res = new NotificationResource($notification);

        return ServiceResponse::success('Notification Updated', $res);
    }



    public function delete($id)
    {
        $user = Auth::user();

        // Find the notification by ID
        $notification = Notification::where([
            'id' => $id
        ])->first();

        if (!$notification) {
            return ServiceResponse::error('Notification not found');
        }

        // Delete the notification
        $notification->delete();

        return ServiceResponse::success('Notification Deleted');
    }




}
