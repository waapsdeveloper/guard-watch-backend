<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\UserResource;
use App\Http\Resources\API\SpaceResource;
use App\Http\Resources\API\EventResource;
use App\Http\Resources\API\InviteResource;

class InviteScanHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return $this->toObject($this);
    }

    public static function toObject($obj, $lang = 'en')
    {
        return [
            "id" => $obj->id,
            'invite_id' => $obj->invite_id,
            'invite_contact_id' => $obj->invite_contact_id,
            'scan_by_user_id' => $obj->scan_by_user_id,
            'scan_date_time' => $obj->scan_date_time,
            'status' => $obj->status,
            // Add other properties if present
            // 'user_id' => $obj->user_id,
            // 'space_id' => $obj->space_id,
            // 'space' => SpaceResource::toObject($obj->space),
            // 'event_id'  => $obj->event_id,
            // 'event' => EventResource::toObject($obj->event),
            // 'comments' => $obj->comments,
            // 'start_date' => $obj->start_date,
            // 'end_date' => $obj->end_date,
            // 'validity' => $obj->validity,
            // 'pass_type' => $obj->pass_type,
            // 'visitor_type' => $obj->visitor_type,
        ];
    }
}
