<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'device_id',
        'phone_number',
        'dial_code'
    ];
}
