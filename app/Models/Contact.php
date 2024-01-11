<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InviteScanHistories;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'dial_code',
        'created_by'
    ];
    public function inviteContacts()
    {
        return $this->hasMany(InviteContact::class);
    }
}
