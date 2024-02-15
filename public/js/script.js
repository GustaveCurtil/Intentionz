let eventsSection =  document.querySelector('.events')

let viewerSection =  document.querySelector('.viewer')

let profileSection =  document.querySelector('.profile')

function seperationHeights() {
    console.log(viewerSection.clientHeight)
    console.log(viewerSection.offsetHeight)

    let seperationLeft = document.querySelector('.seperation-left');
    let seperationRight = document.querySelector('.seperation-right');
    if (eventsSection.clientHeight > viewerSection.clientHeight) {
        seperationLeft.style.height = eventsSection.clientHeight + 'px';
    } else {
        seperationLeft.style.height = viewerSection.clientHeight + 'px';
    }

    if (profileSection.clientHeight > viewerSection.clientHeight) {
        seperationRight.style.height = profileSection.clientHeight + 'px';
    } else {
        seperationRight.style.height = viewerSection.clientHeight + 'px';
    }
}

const view =  document.querySelector('.view-event')

let panels = document.querySelectorAll(".panel")
let events = document.querySelectorAll(".event")


//Check voor wat er eventueel open stond in de vorige sessie
document.addEventListener("DOMContentLoaded", ()=> {

    if (sessionStorage.getItem('event')) {
        if (sessionStorage.getItem('number of events') == events.length) {
            view.innerHTML = "";
            const event = events[sessionStorage.getItem('event')];
            let hiddenInfo = event.querySelector(".hidden")
            event.showInfo = false;
            event.style.backgroundColor = "var(--selection)";
            event.style.backgroundColor = "var(--selection)";
            event.showInfo = true;
            view.innerHTML = hiddenInfo.innerHTML;
        } else {
            view.innerHTML = "";  
            sessionStorage.setItem('number of events', events.length) 
        }
    }

    for (let i = 0; i < panels.length; i++) {
        const panel = panels[i];
        let window= panel.querySelector(".window");
        window.style.display = sessionStorage.getItem('panel'+i);
    }

    seperationHeights()
});


//OPEN EN DICHT-KLAPPEN
for (let i = 0; i < panels.length; i++) {
    const panel = panels[i];
    let bar = panel.querySelector(".bar")
    let window= panel.querySelector(".window")

    bar.addEventListener("click", () => {
        let windowStyle = window.style.display || getComputedStyle(window).display;
        if (windowStyle === "flex") {
            window.style.display = "none"
        } else {
            window.style.display = "flex"
        }
        sessionStorage.setItem('panel' + i, window.style.display);
        seperationHeights()
    })
    
}


//SELECTEER EVENT VOOR IN VIEW VENSTER
for (let i = 0; i < events.length; i++) {
    const event = events[i];
    event.showInfo = false;
    event.addEventListener("click", ()=> {
        let hiddenInfo = event.querySelector(".hidden")
        view.innerHTML = "";
        if (!event.showInfo) {
            events.forEach(event => {
                event.style.backgroundColor = "var(--black)";
                event.showInfo = false;  
            });
            event.style.backgroundColor = "var(--selection)";
            event.showInfo = true;
            view.innerHTML = hiddenInfo.innerHTML;
            sessionStorage.setItem('event', i)
        } else {
            event.style.backgroundColor = "var(--black)";  
            event.showInfo = false;
            sessionStorage.removeItem('event');
        }
        
        seperationHeights()

        //URL KNOP KOPIEREN
        let copyButton = view.querySelector(".invite-url")
        if (copyButton) {
            copyButton.addEventListener("click", () => {
                navigator.clipboard.writeText(copyButton.textContent);
                alert("Uitnodigingslink gekopieerd:\n" + copyButton.textContent);
            })   
        }

   })
}


//Image not bigger then... 

function VerifyUploadSizeIsOK()
{
   /* Attached file size check. Will Bontrager Software LLC, https://www.willmaster.com */
   var UploadFieldID = "file-upload";
   var MaxSizeInBytes = 51200;
   var fld = document.getElementById(UploadFieldID);
   if( fld.files && fld.files.length == 1 && fld.files[0].size > MaxSizeInBytes )
   {
      alert("Converteer de afbeelding (idealiter Z/W) zodat ie minder groot is dan: " + parseInt(MaxSizeInBytes/1024) + "kb. Ik raad je aan om jouw foto een korrel te geven met deze easy-to-user tool: https://doodad.dev/dither-me-this/");
      return false;
   }
   return true;
}
