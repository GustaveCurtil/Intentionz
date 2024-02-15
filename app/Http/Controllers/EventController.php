<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function createEvent(Request $request) {
        $inputs = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'title' => 'min:3', 
            'location' => 'required', 
            'description' => 'nullable', 
            'location_url' => 'nullable', 
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $inputs['title'] = strip_tags($inputs['title']); //tegen lastige injecties enzu
        if ($inputs['description'] !== null) {
            $allowed_tags = '<p><u><b><i><em><ul><ol><li><h3><cite><br><hr><red><left><right><middle>';
            $inputs['description'] = strip_tags($inputs['description'], $allowed_tags);
        }
        if ($inputs['location_url'] !== null) {
            $inputs['location_url'] = strip_tags($inputs['location_url']);
        }
        $inputs['creator_id'] = auth()->id();

        $inputs['invitation_slug'] = "pri" . Str::random(8);

        $filename = 'www-intentionz-be_' . Str::random(8);

        if (isset($inputs['picture'])) {
            $file = $inputs['picture']->storeAs('uploads', $filename, 'public');

            $inputs['picture_path'] = $file;
        }       

        UserEvent::create($inputs);
        
        return redirect('/');
    }

    public function deleteEvent($id) {
        $user = Auth::user();

        $event = UserEvent::where('id', $id)->where('creator_id', $user->id)->first();
    
        if ($event) {
            $event->delete();   
        }

        return redirect('/');
    }

    public function editEvent($id) {
        $user = Auth::user();

        $event = UserEvent::where('id', $id)->where('creator_id', $user->id)->first();

        if (!$event) {
            redirect('/');
        } else {
            view('edit');
        }
    }


}
