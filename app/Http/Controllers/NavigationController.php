<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PublicEvent;
use App\Models\PrivateEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{

    public function show($slug = null){

        $user = User::where('id', Auth::id())->first();

        if ($user) {
            // $contacts = $user->contacts()->with('contact2')->get();
            $contacts = $user->contacts()->leftJoin('users AS contact2', 'contacts.user_id2', '=', 'contact2.id')->orderBy('contact2.name')->get(['contacts.*']);

            $events = PrivateEvent::where(function ($query) use ($user) {
                $query->whereIn('id', function ($query) use ($user) {
                    $query->select('private_event_id')
                        ->from('invitations')
                        ->where('user_id', $user->id)
                        ->distinct();
                })
                ->orWhere('creator_id', $user->id); // Include events where creator_id matches $user->id
            })
            ->whereDate('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('time')
            ->get();
            
            $events = $this->formatDatetime($events);

    
            $goingEvents = PrivateEvent::with(['invitations' => function ($query) {
                $query->where('going', true)->with('invitee');
            }])
            ->whereHas('invitations', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('going', true);
            })
            ->get();

            $goingEvents = $this->formatDatetime($goingEvents);

            $organisingEvents = PrivateEvent::where('creator_id', $user->id)->whereDate('date', '>=', Carbon::today())->orderBy('date')->orderBy('time')->get();
            $organisingEvents = $this->formatDatetime($organisingEvents);

            return view('home', [
                'user' => $user, 
                'contacts' => $contacts,
                'events' => $events,
                'goingEvents' => $goingEvents, 
                'organisingEvents' => $organisingEvents
            ]);  
        } else {
            return view('home')->with('clearSessionStorage', true);;
        }

    }

    public function formatDatetime($events) {
        foreach ($events as $event) {
            $formattedDate = date('d/m', strtotime($event->date));
            $formattedTime = date('H:i', strtotime($event->time));
            
            $event->date = $formattedDate;
            $event->time = $formattedTime;
        }
        return $events;
    }


}
