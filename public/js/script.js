const view =  document.querySelector('.view-event')
let panels = document.querySelectorAll(".panel")
let events = document.querySelectorAll(".event")


//Check voor wat er eventueel open stond in de vorige sessie
document.addEventListener("DOMContentLoaded", ()=> {

    if (sessionStorage.getItem('number of events') == events.length) {
        view.innerHTML = "";
        const event = events[sessionStorage.getItem('event')];
        let hiddenInfo = event.querySelector(".hidden")
        event.showInfo = false;
        event.style.backgroundColor = "yellow"
        event.style.backgroundColor = "yellow";
        event.showInfo = true;
        view.innerHTML = hiddenInfo.innerHTML;
    } else {
         view.innerHTML = "";  
         sessionStorage.setItem('number of events', events.length) 
    }

    


    for (let i = 0; i < panels.length; i++) {
        const panel = panels[i];
        let window= panel.querySelector(".window");
        window.style.display = sessionStorage.getItem('panel'+i);
    }

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
                event.style.backgroundColor = "white";
                event.showInfo = false;  
            });
            event.style.backgroundColor = "yellow";
            event.showInfo = true;
            view.innerHTML = hiddenInfo.innerHTML;
            sessionStorage.setItem('event', i)

        } else {
            event.style.backgroundColor = "white";  
            event.showInfo = false;
            sessionStorage.removeItem('event');
        }
   })
}




