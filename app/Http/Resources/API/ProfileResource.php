<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return self::toObject($this);
    }

    public static function toObject($obj, $lang = 'en')
    {
        return [
            "id" => $obj->id,
            "user_id" => $obj->user->id,
            "space_id" => $obj->space->id,
            "title" => $obj->title,
            "description" => $obj->description,
            'last_active_hour' => $obj->last_active_hour,
            'picture' => $obj->picture,
        ];
    }
}
