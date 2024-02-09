<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'private_event_id',
        'user_id'
    ];

    public function event() {
        return $this->belongsTo(User::class, 'private_event_id');
    }

    public function invitee() {
        return $this->belongsTo(User::class, 'user_id');
    }

    

}
