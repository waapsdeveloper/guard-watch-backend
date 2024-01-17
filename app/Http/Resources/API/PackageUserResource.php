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
            $data = [
                "id" => $obj->id,
                "package_id" => optional($obj->package)->id,
                "user_id" => optional($obj->user)->id,
                'cost' => optional($obj->package)->cost,
                'purchase_date' => $obj->purchase_date,
                'expiry_date' => $obj->expiry_date,
            ];

            return $data;
        }

    }
