<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\User;
// use App\Models\Space;
// use App\Models\Event;

class InviteScanHistories extends Model
{
    use HasFactory;



    protected $fillable = [
        'invite_id',
        'invite_contact_id',
        'scan_by_user_id',
        'scan_date_time',
        'status'
    ];


}
