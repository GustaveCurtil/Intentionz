<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    use HasFactory;

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function guests()
    {
        return $this->invitations();
    }
    
    public function goingGuests()
    {
        return $this->invitations()->where('response', true);
    }

    public function notGoingGuests()
    {
        return $this->invitations()->where('response', false);
    }


    protected $fillable = [
        'date',
        'time',
        'title', 
        'description', 
        'location', 
        'location_url', 
        'picture_path', 
        'invitation_slug', 
        'creator_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
