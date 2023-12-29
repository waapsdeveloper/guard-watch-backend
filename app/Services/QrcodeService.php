<?php

namespace App\Services;
use App\Models\Qrcode;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\QrcodeResource;
use App\Http\Resources\API\QrcodeCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QrcodeService {



    public function __construct()
    {

    }

    public function list($data){

        $user = Auth::user();
        $Qrcode = Qrcode::where(['user_id' => $user->id])->get();
        $list = new QrcodeCollection($Qrcode);
        return ServiceResponse::success('Qrcode List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Qrcode::where([
            'user_id' => $user->id,
            'space_id' => $data['space_id']
        ])->first();

        if($item){
            return ServiceResponse::error('Qrcode Already Exist');
        }

        $item = new Qrcode();
        $item->user_id = $user->id;
        $item->space_id = $data['space_id'];
        $item->User_id = $data['User_id'];
        $item->qr_code = $data['qr_code'];
        $item->save();



        $res = new QrcodeResource($item);

        return ServiceResponse::success('Qrcode Add', $res);

    }

    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Qrcode::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Qrcode Does not Exist');
        }
        $item->space_id = $data['space_id'];
        $item->User_id = $data['User_id'];
        $item->qr_code = $data['qr_code'];
        $item->save();




        $res = new QrcodeResource($item);

        return ServiceResponse::success('Qrcode Edit', $res);

    }

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Qrcode::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Qrcode Does not Exist With id');
        }

        $res = new QrcodeResource($item);

        return ServiceResponse::success('Contact One', $res);

    }

    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = Qrcode::where([
            'id' => $data['id'],
            'user_id' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Qrcode Does not Exist');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Qrcode Deleted', $res);

    }



}
