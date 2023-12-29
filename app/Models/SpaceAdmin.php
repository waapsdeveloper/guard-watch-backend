<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_id',
        'space_id',
        'role_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function space(){
        return $this->belongsTo(Space::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
