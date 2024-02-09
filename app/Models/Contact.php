<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id1',
        'event_id2'
    ];

    public function contact1() {
        return $this->belongsTo(User::class, 'user_id1');
    }

    public function contact2() {
        return $this->belongsTo(User::class, 'user_id2');
    }
}
