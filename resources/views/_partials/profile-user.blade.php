<div class="panel">
    <div class="bar">
        <h2>Welkom, {{$user->name}}</h2>
    </div>
    <div class="window">
        {{-- <form action="/add-email" method="POST">
            @csrf
            <input type="email" name="email" placeholder="email"> 
            @method('PUT')
            <button>Wijzig email</button>
        </form> --}}
        <form action="/logout" method="POST" class="buttonform">
            @csrf
            <button>Log out</button>
        </form>
        <form action="/delete" method="POST" class="buttonform">
            @csrf
            @method('DELETE')
            <button>Verwijder account</button>
        </form>
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Contacten</h2>
    </div>
    <div class="window">
        @if (!empty($contacts) && count($contacts) > 0)
        <ul>
        @foreach ($contacts as $contact)
        <li>{{ $contact->contact2->name}}</li>
        @endforeach
        </ul>
        @endif
        <form action="/add-contact" method="POST">
            @csrf
            <input type="text" name="contact-name" placeholder="Vul een gebruikersnaam in"/>
            <button>Voeg toe</button>
        </form>
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Gaan</h2>
    </div>
    <div class="window">
        @if (!empty($goingEvents) && count($goingEvents) > 0)
            @foreach ($goingEvents as $event)
            <div class="event">
                <table>
                    <tr>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->title }}</td>
                    </tr>
                    <tr>
                        <td>{{ $event->time }}</td>
                        <td>{{ $event->user->name}}</td>
                    </tr>
                </table>
                @include("_partials.event-hidden", ['event' => $event])
            </div>
            @endforeach
        @else
            <p>Nergens...</p>
        @endif
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Jouw events</h2>
    </div>
    <div class="window">
        @if (!empty($organisingEvents) && count($organisingEvents) > 0)
        @foreach ($organisingEvents as $event)
        <div class="event">
            <table>
                <tr>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->title }}</td>
                </tr>
                <tr>
                    <td>{{ $event->time }}</td>
                    <td>{{ $event->user->name}}</td>
                </tr>
            </table>
            @include("_partials.event-hidden", ['event' => $event])
        </div>
        @endforeach
        @else
        <p>Geen evenementen</p>
        @endif
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Maak een evenement aan</h2>
    </div>
    <div class="window"  style="display: flex">
        <form action="/create" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Titel">
            <input type="date" name='date'>
            <input type="time"  name='time'>
            <input type="text" name="location" placeholder="Locatie naam">
            <textarea name="description" placeholder="Tekstje voor warm te maken (optioneel)"></textarea>
            <input type="text" name="location_url" placeholder="Locatie URL (optioneel)">
            {{-- <div class="selection">
                <input type="radio" id="private" name="private-public" value="private" checked>
                <label for="private">Private</label>
                <input type="radio" id="public" name="private-public" value="public">
                <label for="public">Public</label>
            </div> --}}
            {{-- <input type="file" accept="image/*"> --}}
            <button>Create event</button>
        </form>
    </div>
</div>
