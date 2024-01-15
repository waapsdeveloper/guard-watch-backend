<?php

namespace App\Services;
use App\Models\Notification;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\NotificationResource;
use App\Http\Resources\API\NotificationCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationService {






    public function list()
    {
        $user = Auth::user();

        // Retrieve the list of notifications for the authenticated user
        $notifications = Notification::get();

        $res = NotificationResource::collection($notifications);

        return ServiceResponse::success('Notification List', $res);
    }



    public function add($data){

    $user = Auth::user();

    // check existing notification
    $existingNotification = Notification::where([
        'title' => $data['title']
    ])->first();

    if($existingNotification){
        return ServiceResponse::error('Notification Already Exists with Title');
    }

    $notification = new Notification();
    $notification->title = $data['title'];
    $notification->description = $data['description'];
    $notification->type = $data['type'];
    $notification->expiry = $data['expiry'];
    $notification->save();

    $res = new NotificationResource($notification);

    return ServiceResponse::success('Notification Added', $res);
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



public function deleteExpiredNotifications()
{
    $createdat = Carbon::now()->subHours(24);

    Notification::where('created_at', '<=', $expiryTime)->delete();
}
}
