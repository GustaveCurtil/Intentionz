@if (!empty($events) && count($events)>0)
<div class="bar">
    <h2>Events</h2>
</div>
<div class="window">
    @foreach ($events as $event)
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
    @endforeach
</div>
@endif
    