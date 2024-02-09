@include("_partials._head")

<body>

    <main>
        <div class="section profile">
            {{-- @include("_partials.header") --}}
            @auth
            @include("_partials.profile-user")
            @else
            @include("_partials.profile-guest")
            @endauth
            
        </div>

        <div class="section viewer">
            
            <div class="view-event">
  
            </div>    

        </div>

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
    <!-- Execute JavaScript to clear sessionStorage -->

    <script>

    </script>

</body>

</html>