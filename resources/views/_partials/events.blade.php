@if (!empty($events) && count($events)>0)
<div class="bar">
    <h2>Evenementen</h2>
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
                <td>{{ $event->location}}</td>
                <td>{{ $event->creator->name}}</td>
            </tr>
        </table>
        <div class="hidden" style="display: none">
        @include("_partials.event-view", ['event' => $event])
        </div>
    </div>
    @endauth
    @endforeach
</div>
@endif
    