<?php

namespace App\Services;
use App\Models\Event;
use App\Helpers\ServiceResponse;
use App\Http\Resources\API\EventResource;
use App\Http\Resources\API\EventCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventsService {



    public function __construct()
    {

    }

    public function list($data){

        $user = Auth::user();
        $events = Event::where(['created_by' => $user->id])->get();
        $list = new EventCollection($events);
        return ServiceResponse::success('Events List', $list);

    }

    public function add($data){

        $user = Auth::user();
        // check existing contact
        $item = Event::where([
            'created_by' => $user->id,
            'title' => $data['title']
        ])->first();

        if($item){
            return ServiceResponse::error('Event Already Exist With title');
        }

        $item = new Event();
        $item->created_by = $user->id;
        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->save();

        $res = new EventResource($item);

        return ServiceResponse::success('Events Add', $res);

    }

    public function edit($data){

        $user = Auth::user();
        // check existing contact
        $item = Event::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Event Does not Exist');
        }

        $item->title = $data['title'];
        $item->description = $data['description'];
        $item->save();

        $res = new EventResource($item);

        return ServiceResponse::success('Event Edit', $res);

    }

    public function byId($data){

        $user = Auth::user();
        // check existing contact
        $item = Event::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Event Does not Exist With Id');
        }

        $res = new EventResource($item);

        return ServiceResponse::success('Event One', $res);

    }

    public function delete($data){

        $user = Auth::user();
        // check existing contact
        $item = Event::where([
            'id' => $data['id'],
            'created_by' => $user->id,
        ])->first();

        if(!$item){
            return ServiceResponse::error('Event Does not Exist');
        }

        $item->delete();

        $res = ['id' => $data['id']];

        return ServiceResponse::success('Event Deleted', $res);

    }
}
