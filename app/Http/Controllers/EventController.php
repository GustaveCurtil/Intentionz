<?php

namespace App\Http\Controllers;

use App\Models\PublicEvent;
use Illuminate\Support\Str;
use App\Models\PrivateEvent;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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
        $inputs['slug'] = "pri" . Str::random(8);
        PrivateEvent::create($inputs);
        
        return redirect('/');
    }


}
