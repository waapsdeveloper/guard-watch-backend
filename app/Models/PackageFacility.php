<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'title',
        'description'
    ];
    public function package()
    {
        return $this->belongsTo(Package::class , 'package_id')->with('cost');
    }
}
