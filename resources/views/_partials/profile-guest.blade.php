
@if (isset($urlEvent)) 

<div class="panel">

    <div class="bar">
        <h2>Login</h2>
    </div>
    <div class="window">
        <form action="/{{$urlEvent->slug}}/login" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Gebruikersnaam" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <button>Login</button>
        </form>
    </div>
</div>
<div class="panel">
    <div class="bar">
        <h2>Registreer</h2>
    </div>
    <div class="window">
        <form action="/{{$urlEvent->slug}}/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Gebruikersnaam" required minlength="2">
            <input type="password" name="password" placeholder="Wachtwoord" required  minlength="3">
            <input type="password" name="password-check" placeholder="Wachtwoord check" required  minlength="3">
            <button>Maak aan</button>
        </form>

    </div>
</div>

@else

<div class="panel">

    <div class="bar">
        <h2>Login</h2>
    </div>
    <div class="window">
        <form action="/login{{ isset($invitation) ? '/' .$invitation->invitation_slug : '' }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Gebruikersnaam" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <button>Login</button>
        </form>
    </div>
</div>
<div class="panel">
    <div class="bar">
        <h2>Registreer</h2>
    </div>
    <div class="window">
        <form action="/register{{ isset($invitation) ? '/' . $invitation->invitation_slug : '' }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Gebruikersnaam" required  minlength="2"> 
            <input type="password" name="password" placeholder="Wachtwoord" required  minlength="3">
            <input type="password" name="password-check" placeholder="Wachtwoord check" required  minlength="3">
            <button>Maak aan</button>
        </form>

    </div>
</div>

@endif
