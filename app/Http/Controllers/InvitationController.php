<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserEvent;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function rsvp($slug, Request $request) {
        $inputs = $request->validate([
            'invited_guest_name' => 'required', 
            'response' => 'required|in:true,false', 
            'invited_user_id' => 'nullable'
        ]);

        $event = UserEvent::where('invitation_slug', $slug)->first();
        $inputs['user_event_id'] = $event->id;


        $user = Auth::user();
        $creator = User::where('id', $event->creator_id)->first();

        if ($user === $creator) {
            dd("please vertel me hoe je tot deze pagina bent geraakt! gustave.curtil@tutanota.com");
        }

        if ($user) {
            $invitation = Invitation::where('user_event_id', $event->id)->where('invited_user_id', $user->id)->first();
            if ($invitation) {
                $invitation->invited_guest_name = $inputs['invited_guest_name'];
                $invitation->response = $inputs['response'] = filter_var($request->input('response'), FILTER_VALIDATE_BOOLEAN);
                $invitation->save();
            } else {
                $inputs['invited_user_id'] = $user->id;
                $inputs['response'] = filter_var($request->input('response'), FILTER_VALIDATE_BOOLEAN);

                Invitation::create($inputs); 
            }

            return redirect('/' . $slug);
        }

        $existingUser = User::where('name', $inputs['invited_guest_name'])->first();

        if ($existingUser) {
            dd("'" . $existingUser->name . "' is al een gebruikersnaam. Zet er een cijferke bij als ge die naam per se wilt gebruiken!");
        }


        $invitation = Invitation::where('user_event_id', $event->id)->where('invited_guest_name', $inputs['invited_guest_name'])->first();
        $inputs['response'] = filter_var($request->input('response'), FILTER_VALIDATE_BOOLEAN);
        if ($invitation) {
            $invitation->response = $inputs['response'];
            $invitation->save();
        } else {
            Invitation::create($inputs); 
        }


        return redirect('/' . $slug);



    }
}