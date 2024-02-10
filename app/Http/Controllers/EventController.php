<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function createEvent(Request $request) {
        $inputs = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'title' => 'min:3', 
            'location' => 'required', 
            'description' => 'nullable', 
            'location_url' => 'nullable'
        ]);

        $inputs['title'] = strip_tags($inputs['title']); //tegen lastige injecties enzu
        if ($inputs['description'] !== null) {
            $inputs['description'] = nl2br(strip_tags($inputs['description']));
        }
        if ($inputs['location_url'] !== null) {
            $inputs['location_url'] = strip_tags($inputs['location_url']);
        }
        $inputs['creator_id'] = auth()->id();


        $inputs['invitation_slug'] = "pri" . Str::random(8);

        UserEvent::create($inputs);
        
        return redirect('/');
    }


}
