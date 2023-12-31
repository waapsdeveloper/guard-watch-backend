<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'start_date',
        'end_date',
        'validity',
        'pass_type',
        'visitor_type',
        'comments'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
