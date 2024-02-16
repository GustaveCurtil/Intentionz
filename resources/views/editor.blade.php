@include("_partials._head")

<body>
    <main>
        <div class="section profile">
            <div class="panel welcome">
                <div class="bar">
                    <h2>Welkom, {{$user->name}}</h2>
                </div>
                <div class="window">
                        <form action="/logout" method="POST" class="buttonform">
                            @csrf
                            <button>Log out</button>
                        </form>
                        <form action="/delete" method="POST" class="buttonform" onsubmit="return confirm('No way back na dit!\nAccount is dan voor altijd ciao...')">
                            @csrf
                            @method('DELETE')
                            <button>Verwijder account</button>
                        </form>
                </div>
            </div>
        </div>
        <div class="seperation-left"></div>
        <div class="section viewer">
            <div class="commands commands-top editor">
                 <a href="/"><button>Terug zonder (nog eens) op te slaan</button></a>
            </div>
            <form action="/editor/edit/{{$event->id}}" method="POST" enctype="multipart/form-data" class="editor">
                @csrf
                <input type="file" accept="image/*" name='picture' id="file-upload">
                <input type="text" name="title" value="{{$event->title}}" required>
                <input type="date" name='date' required min="<?php echo date("Y-m-d"); ?>" value="{{$event->date}}">
                <input type="time"  name='time' required value="{{$event->time}}">
                <input type="text" name="location" value="{{$event->location}}" required>
                <input type="url" name="location_url" value="{{$event->location_url}}" placeholder="Locatie url (optioneel)">
                <textarea name="description">{{$event->description}}</textarea>
                @method('PUT')
                <button onclick="return VerifyUploadSizeIsOK()">Opslaan</button>
            </form>
        </div>
        <div class="seperation-right"></div>
        <div class="section events">
            <div class="bar"><h2>Handleiding</h2></div>
            <div class="HTMLeditor">
                <p>'Enters' worden automatisch opgeslaan als &lt;br /&gt;. (Laat maar weten als of dit niet eerder verwarrend is ;))</p>
                <groot>&lt;groot&gt;groot&lt;/groot&gt;</groot>
                <klein>&lt;klein&gt;klein&lt;/klein&gt;</klein>
                <links><p>&lt;links&gt;links uitlijnen&lt;/links&gt;</p></links>
                <midden><p>&lt;midden&gt;midden uitlijnen&lt;/midden&gt;</p></midden>
                <rechts><p>&lt;rechts&gt;rechts uitlijnen&lt;/rechts&gt;</p></rechts>
                <links>
                    <b><p>&lt;b&gt;vet&lt;/b&gt;</p></b>
                    <i><p>&lt;i&gt;schuin&lt;/i&gt;</p></i>
                    <u><p>&lt;u&gt;onderlijnd&lt;/u&gt;</p></u>
                </links>
                met &lt;hr&gt; maak je een horizontale lijn<rood><hr></rood>
                <p>&lt;oranje&gt;<oranje>oranje</oranje>&lt;/oranje&gt;</p>
                <p>&lt;markering-oranje&gt;<markering-oranje>markering-oranje</markering-oranje>&lt;/markering-oranje&gt;</p>
                <p style="background-color: rgba(255, 255, 255, 0)">Kleuren: <zwart>zwart</zwart>, <markering-zwart><wit>wit</wit></markering-zwart>, <rood>rood</rood>, <groen>groen</groen>, <blauw>blauw</blauw>, <geel>geel</geel>, <cyaan>cyaan</cyaan>, <magenta>magenta</magenta>, <grijs>grijs</grijs>, <donkergrijs>donkergrijs</donkergrijs>, <markering-zwart><lichtgrijs>lichtgrijs</lichtgrijs></markering-zwart>, <markering-zwart><zilver>zilver</zilver></markering-zwart>, <marineblauw>marineblauw</marineblauw>, <olijfgroen>olijfgroen</olijfgroen>, <paars>paars</paars>, <teal>teal</teal>, <bruin>bruin</bruin>, <oranje>oranje</oranje>, <markering-zwart><roze>roze</roze></markering-zwart>, <goud>goud</goud>.</p>
        </div>
        </div>
    </main>

</body>

</html>