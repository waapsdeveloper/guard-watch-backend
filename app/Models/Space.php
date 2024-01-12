<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'description',
        'name',
        'location',
    ];

    public function events(){
        return $this->hasMany(Event::class, 'space_id', 'id');
    }

    public function invites(){
        return $this->hasMany(Invite::class, 'space_id', 'id');
    }
}
