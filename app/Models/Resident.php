<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'name',
        'dial_code',
        'phone_number',
    ];

    public function house(){
        return $this->belongsTo(House::class );
    }

}
