<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cost',
        'picture',
    ];
    public function package()
    {
        return $this->belongsTo(Package::class , 'package_id')->with('cost');
    }

}
