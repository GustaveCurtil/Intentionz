<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function addContact(Request $request) {
        $input = $request->validate([
            'contact-name' => 'required'
        ]);

        $user = User::where('id', Auth::id())->first();
        $contact = User::where('name', $input['contact-name'])->first();

        if (!$contact) {
            //bericht dat zegt: 'Deze user bestaat niet'
            dd("Deze user bestaat niet");
        }

        if ($contact->id === $user->id) {
            //bericht dat zegt: 'Ge kunt niet u eige toevoegen bro, da's raar!'
            dd("This is you bro");
        }

        $existingConnection = Contact::where('user_id1', $user->id)->where('user_id2', $contact->id)->exists();

        if (!$existingConnection) {
            $connection = new Contact();

            $connection->user_id1 = $user->id;
            $connection->user_id2 = $contact->id;
    
            $connection->save();
        } else {
            dd("Staat al tussen uw contacten copain");
        }
        
        return redirect('/');
    }

    public function inviteContacts(Request $request, $eventId) {
        $inputs = $request->validate([
            'name' => 'required'
        ]);
        $user = User::where('id', Auth::id())->first();
        $invitee = Contact::join('users', 'contacts.user_id2', '=', 'users.id')->where('users.name', $inputs['name'])->where('contacts.user_id1', $user->id)->first();
        if ($invitee) {
            $existingInvitation = Invitation::where('private_event_id', $eventId)->where('user_id', $invitee->id)->exists();
            if (!$existingInvitation) {
                $invitation = new Invitation();

                $invitation->private_event_id = $eventId;
                $invitation->user_id = $invitee->id;
        
                $invitation->save();
            }

        } else {
            dd("niet gevonden");
        }
        return redirect('/');
    }

    public function going($eventId) {
        $user = User::where('id', Auth::id())->first();
        $invitation = Invitation::where('user_id', $user->id)->where('private_event_id', $eventId)->first();

        if (!$invitation->going) {
            $invitation->going = true;
        } else {
            $invitation->going = false;
        }
        
        $invitation->save();
        return redirect('/');
    }
}
