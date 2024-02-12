{{-- @if (!empty($events) && count($events)>0) --}}
<div class="bar">
    <h2>Events</h2>
</div>
<div class="window">
    <div class="event">
        <table>
            <tr>
                <td>12/02</td>
                <td>Titel van het evenement</td>
            </tr>
            <tr>
                <td>20:30</td>
                <td>uitgenodigd door FeliceVTG</td>
            </tr>
        </table>
    </div>
    {{-- @foreach ($events as $event)
    @auth
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
    @endauth
    @endforeach --}}
</div>
{{-- @endif --}}
    