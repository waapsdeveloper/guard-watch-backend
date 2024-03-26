<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaceResource extends JsonResource
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
        // Accessing coordinates as array

        $cor = $obj->coordinates;
        $coordinates = $cor ? unpack('x/x/x/x/corder/Ltype/dlatitude/dlongitude', $obj->coordinates) : null;

        return [
            "id" => $obj->id,
            "title" => $obj->title,
            "description" => $obj->description,
            "type" => $obj->type,
            "address" => $obj->address,
            "coordinates" => $coordinates
        ];
    }
}
