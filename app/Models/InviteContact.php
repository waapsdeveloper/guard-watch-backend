<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invite_id',
        'contact_id',
        'name',
        'dial_code',
        'phone_number',
    ];
}
