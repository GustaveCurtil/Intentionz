<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicEvent extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'date',
        'time',
        'title', 
        'description', 
        'location', 
        'location_url', 
        'organisor_id', 
        'slug'
    ];
}
