<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InviteScanHistoryService;
use Illuminate\Support\Facades\Validator;


class InviteScanHistoryController extends Controller
{


    protected $service;

    public function __construct(InviteScanHistoryService $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        $data = $request->all();

        // Call the service to get the data
        $res = $this->service->list($data);

        // Check if the service response is successful
        if ($res == false) {
            return self::failure($res['message'], $res);
        }

        // Return a successful response
        return self::success("", $res);
    }



    public function add(Request $request)
    {

        $data = $request->all();

        // Validating the required fields
        $validation = Validator::make($data, [
            'invite_id' => 'required|int|exists:invites,id',
            'invite_contact_id' => 'required|int|exists:invite_contacts,id',
            'scan_by_user_id' => 'required|int|exists:users,id',
            'scan_date_time' => 'required|date',
            'status' => 'required|string',
        ]);
        // dd($validation);

        // If validation failed
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        // Your existing logic to add the data
        $res = $this->service->add($data);
        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Scan history added successfully", $res);
    }


    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;

        // Validating the required fields
        $validation = Validator::make($data, [
            'invite_id' => 'required|exists:invites,id',
            'invite_contact_id' => 'required',
            'scan_by_user_id' => 'required',
            'scan_date_time' => 'required',
            'status' => 'required',
        ]);

        // If validation fails
        if ($validation->fails()) {
            return self::failure($validation->errors()->first());
        }

        // Call the service method for editing
        $res = $this->service->edit($data);

        // Check the result from the service
        if ($res['bool'] == false) {
            return self::failure($res['message'], $res);
        }

        return self::success("Test Result", $res);
    }

    public function delete(Request $request, $id)
    {
        $data = [
            'id' => $id,
        ];

        // Validate the required fields
        $validation = Validator::make($data, [
            'id' => 'required|exists:invites,id',
        ]);

        // If validation failed
        if ($validation->fails()) {
            return $this->failure($validation->errors()->first());
        }

        // Call the service to delete the record
        $res = $this->service->delete($data);

        if (!$res['bool']) {
            return $this->failure($res['message'], $res);
        }

        return $this->success("", $res);
    }



}
