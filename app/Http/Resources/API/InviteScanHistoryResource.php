<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\UserResource;
use App\Http\Resources\API\SpaceResource;
use App\Http\Resources\API\EventResource;

class InviteScanHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $obj = self::toObject($this);
        return $obj;
    }

    public static function toObject($obj, $lang = 'en')
    {
        return [
            "invite_id" =>InviteResource::toObject($obj->invite_id),
            'invite_contact_id' => $obj->invite_contact_id,
            'scan_by_user_id' => $obj->scan_by_user_id,
            'scan_date_time'  => $obj->scan_date_time,
            'status ' => $obj->status,
            // 'user' => UserResource::toObject($obj->user),
            // 'space' => SpaceResource::toObject($obj->space),
            // 'event' => EventResource::toObject($obj->event),
            // 'start_date' => $obj->start_date,
            // 'end_date' => $obj->end_date,
            // 'validity' => $obj->validity,
            // 'pass_type' => $obj->pass_type,
            // 'visitor_type' => $obj->visitor_type,
        ];
    }
}
