<?php

namespace App\Services;
use App\Models\Notification;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\NotificationResource;
use App\Http\Resources\API\NotificationCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationService {

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


}
