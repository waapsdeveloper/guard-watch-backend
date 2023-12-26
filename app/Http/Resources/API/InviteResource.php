<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\UserResource;
use App\Http\Resources\API\SpaceResource;
use App\Http\Resources\API\EventResource;

class InviteResource extends JsonResource
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
            "id" => $obj->id,
            'user_id' => $obj->user_id,
            'user' => UserResource::toObject($obj->user),
            'space_id' => $obj->space_id,
            'space' => SpaceResource::toObject($obj->space),
            'event_id'  => $obj->event_id,
            'event' => EventResource::toObject($obj->event),
            'comments' => $obj->comments,
            'start_date' => $obj->start_date,
            'end_date' => $obj->end_date,
            'validity' => $obj->validity,
            'pass_type' => $obj->pass_type,
            'visitor_type' => $obj->visitor_type,
        ];
    }
}
