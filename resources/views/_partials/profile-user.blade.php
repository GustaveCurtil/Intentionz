<div class="panel welcome">
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
            <form action="/delete" method="POST" class="buttonform" onsubmit="return confirm('No way back na dit!\nAccount is dan voor altijd ciao...')">
                @csrf
                @method('DELETE')
                <button>Verwijder account</button>
            </form>
    
    </div>
</div>

{{-- Enkel zichtbaar indien er iets is om te tonen --}}
@if (!empty($yourEvents) && count($yourEvents) > 0)
<div class="panel">
    <div class="bar">
        <h2>Door jou georganiseerd</h2>
    </div>
    <div class="window">
        @foreach ($yourEvents as $event)
        <div class="event event-small">
            <table>
                <tr>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->title }}</td>
                </tr>
            </table>
            <div class="hidden" style="display: none">
                @include("_partials.event-view", ['event' => $event])
                </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="panel">
    <div class="bar">
        <h2>Maak een evenement aan</h2>
    </div>
    <div class="window">
        <form action="/create" method="POST" enctype="multipart/form-data">>
            @csrf
            <input type="text" name="title" placeholder="Titel" required>
            <input type="date" name='date' required min="<?php echo date("Y-m-d"); ?>">
            <input type="time"  name='time' required>
            <input type="text" name="location" placeholder="Locatie naam" required>
            <input type="url" name="location_url" placeholder="Locatie url (optioneel)">
            <textarea name="description" placeholder="Tekstje voor warm te maken (optioneel)"></textarea>
            <input type="file" accept="image/*" name='picture' id="file-upload">
            <button onclick="return VerifyUploadSizeIsOK()">Create event</button>
        </form>
    </div>
</div>

