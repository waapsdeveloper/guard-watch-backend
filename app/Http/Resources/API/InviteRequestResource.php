<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use App\Models\Space;
use App\Http\Resources\API\SpaceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InviteRequestResource extends JsonResource
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
            'id' => $obj->id,
            'name' => $obj->name,
            'phone_number' => $obj->name,
            'dial_code'  => $obj->dial_code,
            'comments' => $obj->comments,
            'space_name' => $obj->$space->space_name,
            'space_name' => $obj->$spacee->space_id
        ];
    }
}
