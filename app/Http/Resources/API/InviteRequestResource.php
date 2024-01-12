<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
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
            'space_id' => $obj->space->id,
            'space_name' => $obj->space->title
        ];
    }
}
