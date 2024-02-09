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
        return view('home');
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
