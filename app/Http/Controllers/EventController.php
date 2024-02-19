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
            'title' => 'required', 
            'location' => 'required', 
            'description' => 'nullable', 
            'location_url' => 'nullable', 
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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

    public function editEvent(UserEvent $event, Request $request) {
        $user = Auth::user();
        if (!$user->id === $event->creator_id) {
            dd("Volgens het systeem zijde niet te eigenaar van dit evenement!");
        } else {
            $inputs = $request->validate([
                'date' => 'required',
                'time' => 'required',
                'title' => 'required', 
                'location' => 'required', 
                'description' => 'nullable', 
                'location_url' => 'nullable', 
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $inputs['title'] = strip_tags($inputs['title']); //tegen lastige injecties enzu
            if ($inputs['description'] !== null) {
                $allowed_tags = '<groot><klein><links><midden><rechts><hr><b><i><u><zwart><markering-zwart><wit><markering-wit><rood><markering-rood><groen><markering-groen><blauw><markering-blauw><geel><markering-geel><cyaan><markering-cyaan><magenta><markering-magenta><grijs><markering-grijs><donkergrijs><markering-donkergrijs><lichtgrijs><markering-lichtgrijs><zilver><markering-zilver><marineblauw><markering-marineblauw><olijfgroen><markering-olijfgroen><paars><markering-paars><teal><markering-teal><bruin><markering-bruin><oranje><markering-oranje><roze><markering-roze><goud><markering-goud>';
                $inputs['description'] = nl2br(strip_tags($inputs['description'], $allowed_tags));
            }

            if ($inputs['location_url'] !== null) {
                $inputs['location_url'] = strip_tags($inputs['location_url']);
            }

            if (isset($inputs['picture'])) {
                $filename = 'www-intentionz-be_' . Str::random(8);
                $file = $inputs['picture']->storeAs('uploads', $filename, 'public');
    
                $inputs['picture_path'] = $file;
            }     

            $event->update($inputs);
            session(['event_id' => $event->id]);
            return redirect('/editor');
        }
        
    }



}
