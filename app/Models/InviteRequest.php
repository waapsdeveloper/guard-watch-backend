<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Space;
use App\Models\Event;
use App\Models\InviteScanHistories;

class InviteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'dial_code',
        'space_id',
        'space_name',
        'date',
        'comments'
    ];

    public function space(){
        return $this->belongsTo(Space::class );
    }

}
