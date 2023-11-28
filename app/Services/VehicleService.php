<?php

namespace App\Services;
use App\Models\Vehicle;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\VehicleResource;
use App\Http\Resources\API\VehicleCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VehicleService {



    public function __construct()
    {

    }

    public function list($data){

        $user = Auth::user();
        $vehicles = Vehicle::where(['created_by' => $user->id])->get();
        $list = new VehicleCollection($vehicles);
        return ServiceResponse::success('Vehicle List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Vehicle::where([
            'created_by' => $user->id,
            'make' => $data['make']
        ])->first();

        if($item){
            return ServiceResponse::error('Vehicle Already Exist With title');
        }

        $item = new Vehicle();
        $item->created_by = $user->id;
        $item->make = $data['make'];
        $item->model = $data['model'];
        $item->year = $data['year'];
        $item->save();

        $res = new VehicleResource($item);

        return ServiceResponse::success('Vehicle Add', $res);

    }

    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Vehicle::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Vehicle Does not Exist');
        }
        $item->make = $data['make'];
        $item->model = $data['model'];
        $item->year = $data['year'];
        $item->save();

        $res = new VehicleResource($item);

        return ServiceResponse::success('Vehicle Edit', $res);

    }

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Vehicle::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Vehicle Does not Exist With id');
        }

        $res = new VehicleResource($item);

        return ServiceResponse::success('Contact One', $res);

    }

    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = Vehicle::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Vehicle Does not Exist');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Vehicle Deleted', $res);

    }



}
