<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $guarded = [
        'invited_user_id'
    ];

    protected $fillable = [
        'user_event_id', 
        'invited_guest_name', 
        'is_going', 
    ];

}
