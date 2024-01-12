<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Space;
use App\Models\Event;
use App\Models\InviteScanHistories;

class InviteRequest extends Model
{
    use HasFactory;

    // event_id: -1,
    // validity: 60,
    // start_date: '',
    // end_date: '',
    // visitor_type: 'guest',
    // pass_type: 'one-time',
    // contacts: []

    protected $fillable = [
        'name',
        'phone_number',
        'dial_code',
        'space_name'
    ];

}
