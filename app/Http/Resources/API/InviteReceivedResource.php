<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InviteReceivedResource extends JsonResource
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
            // "id": 116,
            // "user_id": null,
            "invite_id" => $obj->invite_id,
            "contact_id" => $obj->contact_id,
            "name" => $obj->name,
            "qrcode" => $obj->qrcode,
            // "is_scanned": 0,
            "dial_code" => $obj->dial_code,
            "phone_number" => $obj->phone_number,
            // "created_at": "2024-01-04T07:18:59.000000Z",
            // "updated_at": "2024-01-04T07:18:59.000000Z",

            // "id": 78,
            "user_id" => $obj->user_id,
            // "space_id": 13,
            // "event_id": 19,
            "start_date" => $obj->satrt_date,
            "end_date" => $obj->end_date,
            // "validity": 720,
            "pass_type" => $obj->pass_type,
            "visitor_type" => $obj->visitor_type,
            "comments" => $obj->comments
            // "created_by": 7,
            // "deleted_at": null,
            // "created_at": "2024-01-04T07:18:57.000000Z",
            // "updated_at": "2024-01-04T07:18:57.000000Z"


        ];
    }
}
