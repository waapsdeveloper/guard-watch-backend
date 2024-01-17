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
        // 'cost',
        'picture',
    ];
    public function packageuser()
    {
        return $this->belongsTo(PackageUser::class);
    }


}
