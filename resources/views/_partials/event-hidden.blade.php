<div class="hidden" style="display: none">
        {{-- @if ($event->user->id === $user->id)
        <div class="commands">  
            <form action="/edit/{{$event->id}}" method="POST" class="buttonform">
                @csrf
                <button>Wijzig</button>
            </form>
            <form action="/delete/{{$event->id}}" method="POST" class="buttonform">
                @csrf
                <button>Verwijder</button>
            </form>
        </div>   
        @endif --}}
        <h2>{{$event->title}}</h2>
        <div class="organisator">Georganiseerd door <strong>{{$event->user->name}}</strong></div>
        <div class="when">VRIJDAG 13 FEBRUARI 2024 om 20u00</div>
        <div class="where">{{$event->location}}
            @if (isset($event->location_url))
            <a href="{{$event->location_url}}" target="_blank">maps</a>     
            @endif    
        </div>
        <p>{!! $event->description !!}</p>
        <div class="invited">Uitgenodigd:         
            @if($event->invitations)
                @foreach($event->invitations->sortBy('invitee.name') as $invitation)
                    {{$invitation->invitee->name}}
                @endforeach
            @endif
        </div>
        <div class="going">Going: 
            @if($event->invitations)
            @foreach($event->invitations->sortBy('invitee.name') as $invitation)
                @if($invitation->going)
                    {{$invitation->invitee->name}}
                @endif
            @endforeach
        @endif
        </div>
        @if ($event->user->id === $user->id)
        <div class="commands">  
            <form action="/invite/{{$event->id}}" method="POST">
                @csrf
                <select name="name">
                    <option value="">Kies uit selectie</option>
                    @foreach ($contacts as $contact)
                    <option value="{{ $contact->contact2->name}}">{{ $contact->contact2->name}}</option>
                    @endforeach
                </select>
                <button>Voeg toe</button>
            </form>
        </div>  
        @else
        <div class="commands">  
            @foreach ($event->invitations as $invitation)
                @if ($invitation->user_id === auth()->id())
                    @if ($invitation->going)
                    <form action="/going/{{$event->id}}" method="POST" class="buttonform">
                        @csrf
                        <button>Toch niet gaan</button>
                    </form>   
                    @else
                    <form action="/going/{{$event->id}}" method="POST" class="buttonform">
                        @csrf
                        <button>Gaan</button>
                    </form>     
                    @endif 
                @endif 
            @endforeach
        </div>  
        @endif
    </div>