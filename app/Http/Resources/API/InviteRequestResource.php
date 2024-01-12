<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use App\Http\Resources\API\SpaceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InviteRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $obj = self::toObject($this);
        return $obj;
    }

    public static function toObject($obj, $lang = 'en')
    {
        $space = $obj->space;

        return [
            'id' => $obj->id,
            'name' => $obj->name,
            'phone_number' => $obj->phone_number, // corrected property name
            'dial_code'  => $obj->dial_code,
            'comments' => $obj->comments,
            // 'space_name' => $space ? $space->title : null,
            // 'space_type' => $space ? $space->space : null,
        ];
    }
}

