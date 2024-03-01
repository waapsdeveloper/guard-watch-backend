<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            "package_id" => $obj->package_id,
            "user_id" => $obj->user_id,
            "title" => $obj->title,
            "description" => $obj->description,
            'last_active_hour'=>$obj->last_active_hour,
            'picture' =>$obj->picture,
        ];
    }
}