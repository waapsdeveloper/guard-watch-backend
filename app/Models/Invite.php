<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'pass_validity',
        'pass_type',
        'visitor_type',
        'description',
        'event_id',
        'space_id',
        'is_quick_pass',
        'pass_start_date',
        'pass_date',
        'lat',
        'lng',
        'is_sent_by_sms'
    ];
}
