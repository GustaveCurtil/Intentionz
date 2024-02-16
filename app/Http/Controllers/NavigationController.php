<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserEvent;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{

    public function show($slug = null) {
        $user = Auth::user();
        $events = UserEvent::all();

        if (!$events->isEmpty()) {
            foreach ($events as $event) {
                $this->formatDatetimeViewer($event);
                $this->formatDatetime($event);
                $event->invitation_link = URL::to($event->invitation_slug);
            }
        }


        if ($slug) {
            $invitation = UserEvent::where('invitation_slug', $slug)->first();

            if ($invitation === null) {
                return redirect('/');
            }

            $this->formatDatetimeViewer($invitation);
  
            $invitation->invitation_link = URL::to($invitation->invitation_slug);

            if ($user) {
                if (!$invitation->creator_id === $user->id) {
                $this->saveInInvitations($user, $invitation);
                }
                $yourEvents = $events->where('creator_id', $user->id)->sortBy('date');
                $invitations = $events->filter(function ($event) use ($user) {
                    return $event->invitations->contains('invited_user_id', $user->id);
                });
                $events = $yourEvents->merge($invitations)->sortBy('date');
                return view('invitation', ['user' => $user, 'events' => $events, 'yourEvents' => $yourEvents, 'invitation' => $invitation]);
            }

            return view('invitation', ['invitation' => $invitation]);
        }


        if ($user) {
            $yourEvents = $events->where('creator_id', $user->id)->sortBy('date');
            $invitations = $events->filter(function ($event) use ($user) {
                return $event->invitations->contains('invited_user_id', $user->id);
            });
            $events = $yourEvents->merge($invitations)->sortBy('date');
            return view('home', ['user' => $user, 'events' => $events, 'yourEvents' => $yourEvents]);
        } else {
            return view('home');
        }
    }


    public function formatDatetime($event) {
        $formattedDate = date('d/m', strtotime($event->date));
        $formattedTime = date('H:i', strtotime($event->time));
        
        $event->date = $formattedDate;
        $event->time = $formattedTime;
        return $event;
    }

    public function formatDatetimeViewer($event) {
        $date = Carbon::createFromFormat('Y-m-d', $event->date);
        $daysOfWeek = ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'];
        $months = [1 => 'Januari', 2 => 'Februari', 3 => 'Maart', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Augustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'December'];
        
        $dayOfWeek = $daysOfWeek[$date->dayOfWeek];
        $day = $date->day;
        $month = $months[$date->month];
        $year = $date->year;

        $formattedTime = date('H\u', strtotime($event->time)) . date('i', strtotime($event->time));
    
        // Format the date
        $formattedDateTime = ucfirst($dayOfWeek) . ' ' . $day . ' ' . $month . ' ' . $year . ' om ' . $formattedTime;
        $event->formattedDateTime = $formattedDateTime;
        return $event;    
    }

    public function saveInInvitations($user, $event) {
            $inputs = [
                'user_event_id' => $event->id,
                'invited_user_id' => $user->id,
            ];
            Invitation::firstOrCreate($inputs);

    }

    public function goToEditor(UserEvent $event) {
        session(['event_id' => $event->id]);

        return redirect('/editor');
    }

    public function showEditor() {
        $eventId = session('event_id');
        $event = UserEvent::find($eventId);
        $user = Auth::user();
        return view("editor", ['event' => $event, 'user' => $user]);
    }
}
