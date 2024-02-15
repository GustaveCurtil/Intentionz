@include("_partials._head")

<body>

    <main>
        <div class="section profile">
            @auth
            @include("_partials.profile-user")
            @else
            @include("_partials.profile-guest")
            @endauth
            
        </div>
        <div class="seperation-left"></div>
        <div class="section viewer">
            
            <div class="view-event">
                @include("_partials.event-view", ['event' => $invitation])
            </div>    

        </div>
        <div class="seperation-right"></div>
        <div class="section events">
            @include("_partials.events")
        </div>
    </main>

    {{-- clear storage when not logged in! --}}
    @auth
    @else    
    <script>
        sessionStorage.clear();
    </script>
    @endauth


    <script>

    </script>

</body>

</html>