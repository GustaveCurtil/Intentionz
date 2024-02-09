<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivateEvent extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'private_event_id');
    }


    protected $fillable = [
        'date',
        'time',
        'title', 
        'description', 
        'location', 
        'location_url', 
        'creator_id', 
        'slug'
    ];

    public function getFormattedDateAttribute()
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $this->date);
        return $carbonDate->format('d/m');
    }

    public function getFormattedTimeAttribute()
    {
        $carbonTime = Carbon::createFromFormat('H:i:s', $this->time);
        return $carbonTime->format('H:i');
    }

        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'invited' => 'array'
    ];

}
