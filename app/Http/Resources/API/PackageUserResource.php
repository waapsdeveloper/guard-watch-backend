<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            "id" => $obj->id,
            "package_id" => $obj->package->id, // Assuming there's a relationship between PackageUser and Package
            "user_id" => $obj->user->id, // Assuming there's a relationship between PackageUser and User
            'cost' => $obj->cost,
        ];
    }
}
