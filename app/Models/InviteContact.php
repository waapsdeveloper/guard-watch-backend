<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Invite;
use App\Models\Contact;

class InviteContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invite_id',
        'contact_id',
        'qrcode',
        'is_scanned',
        'name',
        'dial_code',
        'phone_number',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function invite()
    {
        return $this->belongsTo(Invite::class, 'invite_id');
    }


    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
