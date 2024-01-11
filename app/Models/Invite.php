<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\User;
use App\Models\Space;
use App\Models\Event;
use App\Models\InviteScanHistories;

class Invite extends Model
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
        'user_id',
        'space_id',
        'event_id',
        'name',
        'phone_number',
        'dial_code',
        'start_date',
        'end_date',
        'validity',
        'pass_type',
        'visitor_type',
        'comments'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function inviteContacts()
    {
        return $this->hasMany(InviteContact::class);
    }
    public function scanHistory()
    {
        return $this->hasMany(InviteScanHistories::class);
    }
}
