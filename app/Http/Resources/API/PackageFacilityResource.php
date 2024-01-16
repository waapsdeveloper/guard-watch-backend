<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageFacilityResource extends JsonResource
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
        $data = [
            "id" => $obj->id,
            "title" => $obj->title,
            "description" => $obj->description,
        ];

        // Check if the 'package' relationship is not null before accessing its 'id' property
        if ($obj->package) {
            $data["package_id"] = $obj->package->id;
        } else {
            $data["package_id"] = null; // Or any default value you want to assign when the relationship is null
        }

        return $data;
    }

}
