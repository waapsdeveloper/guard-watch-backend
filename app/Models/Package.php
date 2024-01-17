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

    public function packageUser()
    {
        return $this->belongsTo(PackageUser::class);
    }
    public function packageFacility()
    {
        return $this->belongsTo(PackageFacility::class);
    }
}
