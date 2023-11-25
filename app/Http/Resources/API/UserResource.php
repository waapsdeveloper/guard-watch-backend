<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "name" => $obj->name,
            "phone_number" => $obj->phone_number,
            "dial_code" => $obj->dial_code,
            "email" => $obj->email,
            "role_id" => $obj->role_id,
            "role" => $obj->role ? $obj->role->name : null
        ];
    }
}
