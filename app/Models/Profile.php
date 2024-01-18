<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Package;
class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'title',
        'description',
        'last_active_hour',
        'picture',
    ];

    public function package(){
        return $this->belongsTo(Package::class );
    }

    public function user(){
        return $this->belongsTo(User::class );
    }

}
