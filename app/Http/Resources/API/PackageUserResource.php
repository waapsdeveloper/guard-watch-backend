<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\API\UserResource;
use App\Http\Resources\API\PackageResource;
class PackageUserResource extends JsonResource
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
        $result = [
            "id" => $obj->id,
            'package_id' => PackageResource::toObject($obj->id),
//            "package_id" => ($obj->package)->id, // Check if $obj->package is null
            "user_id" => ($obj->user)->id, // Check if $obj->user is null
            'cost' => ($obj->package)->cost, // Check if $obj->package is null
            'purchase_date' => $obj->purchase_date,
        ];

        return $result;
    }

}
