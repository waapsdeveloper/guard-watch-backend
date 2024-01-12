<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\UserResource;
use App\Http\Resources\API\SpaceResource;
use App\Http\Resources\API\EventResource;

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
            'name' => $obj->name,
            'phone_number' => $obj->name,
            'dial_code'  => $obj->dial_code,
            'space_name' => $obj->space_name
        ];
    }
}
