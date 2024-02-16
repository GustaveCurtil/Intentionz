    @if (isset($user))
    @if ($event->creator->id === $user->id)
    <div class="commands">  
        <form action="/editor/{{$event->id}}" method="POST" class="buttonform">
            @csrf
            <button>Bewerk</button>
        </form>
        <form action="/delete/{{$event->id}}" method="POST" class="buttonform"  onsubmit="return confirm('No way back na dit!\nEvent is dan voor altijd ciao...')">
            @csrf
            @method('DELETE')
            <button>Verwijder</button>
        </form>
    </div>   
    @endif
    @endif
    <div class="invitation">
        <div class="invitation-content">
            <div class="info-wrapper">
        @if (isset($event->picture_path))
        <p class="img"><img src="/storage/{{$event->picture_path}}" loading="lazy"></p>
        @endif
        <h1>{{$event->title}}</h1>
        <div class="organisator">Georganiseerd door <strong>{{$event->creator->name}}</strong></div>
        <div class="when">{{$event->formattedDateTime}}</div>
        <div class="where">{{$event->location}}
            @if (isset($event->location_url))
            <a href="{{$event->location_url}}" target="_blank">maps</a>     
            @endif    
        </div>
        <br>
        <div class="HTMLeditor">{!! $event->description !!}</div>
        <br>
        </div>
        <div class="going">
            <span>Gaan</span> ❀
            @if($event->goingGuests)
            @foreach ($event->goingGuests as $guest)
                @if($guest->invited_guest_name)
                    {{$guest->invited_guest_name}} ❀ 
                @endif
            @endforeach
        @endif
        <br>
            <div class="not-going">
                <span>Gaan niet</span> ♥
                @if($event->notGoingGuests)
                    @foreach ($event->notGoingGuests as $guest)
                        @if($guest->invited_guest_name)
                            {{$guest->invited_guest_name}} ♥ 
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>
    @if (isset($user))
    @if ($event->creator->id === $user->id)
    <div class="commands commands-bottom">  
        <button class="invite-url">{{$event->invitation_link}}</button>
    </div>  
    @else
    <div class="commands commands-bottom">
        <form action="/{{$event->invitation_slug}}/rsvp" method="POST" class="rsvp">
            @csrf
            <input type="text" name="invited_guest_name" placeholder="{{$user->name}}" value="{{$user->name}}" maxlength="20">
            <div class="response">
            <button name='response' value='true'>Gaan</button>
            <button name='response' value='false'>Niet gaan</button>
            </div>
        </form> 
    </div>  
    @endif
    @else
    <div class="commands commands-bottom">
        <form action="/{{$event->invitation_slug}}/rsvp" class="rsvp" method="POST">
            @csrf
            <input type="text" name="invited_guest_name" placeholder="Wie bent ge?" maxlength="20">
            <div class="response">
            <button name='response' value='true'>Gaan</button>
            <button name='response' value='false'>Niet gaan</button>
            </div>
        </form>  
    </div>  

    @endif