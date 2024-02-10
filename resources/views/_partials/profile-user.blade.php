<div class="panel welcome">
    <div class="bar">
        <h2>Welkom, $user->name</h2>
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
            <form action="/delete" method="POST" class="buttonform" onsubmit="return confirm('No way back na dit!\nAccount is dan voor altijd ciao...')">
                @csrf
                @method('DELETE')
                <button>Verwijder account</button>
            </form>
    
    </div>
</div>


<div class="panel">
    <div class="bar">
        <h2>Agenda</h2>
    </div>
    <div class="window">
        <table class="agenda">
            <thead>
                <td>MA</td>
                <td>DI</td>
                <td>WO</td>
                <td>DO</td>
                <td>VR</td>
                <td>ZA</td>
                <td>ZO</td>
            </thead>
            <tbody>
                <tr>
                    <td>12/02</td>
                    <td>13/02</td>
                    <td>14/02</td>
                    <td>15/02</td>
                    <td>16/02</td>
                    <td>17/02</td>
                    <td>18/02</td>
                </tr>
                <tr>
                    <td>19/02</td>
                    <td>20/02</td>
                    <td>21/02</td>
                    <td>22/02</td>
                    <td>23/02</td>
                    <td>24/02</td>
                    <td>25/02</td>
                </tr>
            </tbody>
        </table>
        {{-- <div class="event event-small">
            <table>
                <tr>
                    <td>23/02</td>
                    <td>Crazy Titel</td>
                </tr>
            </table>
        </div>
        <div class="event event-small">
            <table>
                <tr>
                    <td>23/02</td>
                    <td>Crazy Titel</td>
                </tr>
            </table>
        </div> --}}
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Laat iets weten</h2>
    </div>
    <div class="window">
        <div class="event event-small">
            <table>
                <tr>
                    <td>23/02</td>
                    <td>Crazy Titel</td>
                </tr>
            </table>
        </div>
        <div class="event event-small">
            <table>
                <tr>
                    <td>23/02</td>
                    <td>Crazy Titel</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Jouw events</h2>
    </div>
    <div class="window">
        <div class="event event-small">
            <table>
                <tr>
                    <td>23/02</td>
                    <td>Crazy Titel</td>
                </tr>
            </table>
        </div>
        <div class="event event-small">
            <table>
                <tr>
                    <td>23/02</td>
                    <td>Crazy Titel</td>
                </tr>
            </table>
        </div>
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
        {{-- <p>Geen evenementen</p> --}}
        @endif
    </div>
</div>

<div class="panel">
    <div class="bar">
        <h2>Maak een evenement aan</h2>
    </div>
    <div class="window">
        <form action="/create" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Titel" required>
            <input type="date" name='date' required min="<?php echo date("Y-m-d"); ?>">
            <input type="time"  name='time' required>
            <input type="text" name="location" placeholder="Locatie naam" required>
            <textarea name="description" placeholder="Tekstje voor warm te maken (optioneel)"></textarea>
            <input type="text" name="location_url" placeholder="Locatie URL (optioneel)">
            <input type="file" accept="image/*">
            <button>Create event</button>
        </form>
    </div>
</div>
