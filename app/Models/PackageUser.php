<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'cost',
        'purchase_date',
        'expiry_date'
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Assuming a relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
