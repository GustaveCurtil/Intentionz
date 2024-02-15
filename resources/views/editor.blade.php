@include("_partials._head")

<body>
    <main>qs qs
        <div class="section profile">
            @include("_partials.profile-user")
        </div>
        <div class="seperation-left"></div>
        <div class="section viewer">
            
            <div class="view-event">
  
            </div>    

        </div>
        <div class="seperation-right"></div>
        <div class="section events">

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