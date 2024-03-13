<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\HouseService;

class HouseController extends Controller
{
    //
    protected $service;

    public function __construct(HouseService $service){
        $this->service = $service;
    }

    public function addHousesBySpaceId(Request $request){

        $data = $request->all();

        $mix = [];

        foreach($data["alphabets"] as $cr ){

            foreach($data["numbers"] as $n){
                $str = $cr . '-' . $n;

                $obj = [
                    'space_id' => $data['space_id'],
                    "name" => $str
                ];


                array_push($mix, $obj);
            }

        };

        //
        $res = $this->service->addHousesBySpaceId($mix);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }

    public function addResidentsByHousesBySpaceId(Request $request){

        $data = $request->all();

        //
        $res = $this->service->addResidentsByHousesBySpaceId($data);

        if($res['bool'] == false){
            return self::failure($res['message'], $res);
        }

        return self::success("", $res);

    }


}
