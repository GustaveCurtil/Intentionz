<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    use HasFactory;

    protected $guarded = ['creator_id'];

    protected $fillable = [
        'date',
        'time',
        'title', 
        'description', 
        'location', 
        'location_url', 
        'picture_path', 
        'invitation_slug'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
