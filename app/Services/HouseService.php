<?php

namespace App\Services;
use App\Models\Space;
use App\Models\SpaceAdmin;
use App\Models\House;
use App\Models\Contact;
use App\Models\Role;
use App\Models\Resident;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\SpaceResource;
use App\Http\Resources\API\SpaceCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HouseService {



    public function __construct()
    {

    }

    public function addHousesBySpaceId($data){

        // $user = Auth::user();
        // $ids = SpaceAdmin::where('user_id', $user->id)->pluck('id');
        // $spaces = Space::whereIn('id', $ids)->get();
        $list = $data; //new SpaceCollection($spaces);

        $d = [];
        foreach($list as $item){


            $e = House::updateOrCreate(
                [ 'space_id' => $item['space_id'], 'name' => $item['name']], // Search condition
                [ 'space_id' => $item['space_id'], 'name' => $item['name']] // Data to update or insert
            );

            array_push($d, $e);
        }

        return ServiceResponse::success('Spaces List', $d);

    }

    public function addResidentsByHousesBySpaceId($data){

        // $user = Auth::user();
        // $ids = SpaceAdmin::where('user_id', $user->id)->pluck('id');
        // $spaces = Space::whereIn('id', $ids)->get();
        //$list = $data; //new SpaceCollection($spaces);

        $spaceId = $data['space_id'];
        $residents = $data['residents'];

        $max = [];
        foreach($residents as $resident){

            $house = House::where(['name' => $resident['house'], 'space_id' => $spaceId ])->first();

            if($house){
                $record = Resident::updateOrCreate(
                    [ 'house_id' => $house['id'], 'phone_number' => $resident['phone_number'], 'dial_code' => $resident['dial_code'] ], // Search condition
                    [ 'house_id' => $house['id'], 'phone_number' => $resident['phone_number'], 'dial_code' => $resident['dial_code'], 'name' => $resident['name']  ], // Search condition
                );

                array_push($max, $record);
            }

        }


        return ServiceResponse::success('Spaces List', $max);

    }




}
