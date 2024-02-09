
@if (isset($urlEvent)) 

<div class="panel">

    <div class="bar">
        <h2>Login</h2>
    </div>
    <div class="window">
        <form action="/{{$urlEvent->slug}}/login" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="password" name="password" placeholder="Password">
            <button>Login</button>
        </form>
    </div>
</div>
<div class="panel">
    <div class="bar">
        <h2>Register</h2>
    </div>
    <div class="window">
        <form action="/{{$urlEvent->slug}}/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="password-check" placeholder="Password check">
            {{-- <input type="email" name="email" placeholder="email"> --}}
            <button>Register</button>
        </form>

    </div>
</div>

@else

<div class="panel">

    <div class="bar">
        <h2>Login</h2>
    </div>
    <div class="window">
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="password" name="password" placeholder="Password">
            <button>Login</button>
        </form>
    </div>
</div>
<div class="panel">
    <div class="bar">
        <h2>Register</h2>
    </div>
    <div class="window">
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="password-check" placeholder="Password check">
            <button>Register</button>
        </form>

    </div>
</div>

@endif
