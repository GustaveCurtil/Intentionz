const view =  document.querySelector('.view-event')
let panels = document.querySelectorAll(".panel")
let events = document.querySelectorAll(".event")
console.log(sessionStorage.getItem('number of events') == events.length)
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


function viewEvent(info) {

    if (info) {
        let event = JSON.parse(info)
        console.log(event)
        let img = document.createElement("img");

        let h2 = document.createElement("h1");
        h2.textContent = event.title;

        let organized = document.createElement("h3");
        // if (event.user) {
        // organized.textContent = "Georganiseerd door " + event.user.name;
        // } else {
        // organized.textContent = "Georganiseerd door " + event.user.name;
        // }
        let DateTime = document.createElement("h3");
        DateTime.textContent = "donderdag " + event.date +  " om " + event.time;

        let location = document.createElement("h3");
        if (event.location_url !== null) {
            location.innerHTML = "<a href='" + event.location_url + "' target='_blank'>" + event.location + "</a>"
        } else {
            location.innerHTML = event.location;
        }

        // viewEvent.appendChild(img);
        viewEvent.appendChild(h2);
        viewEvent.appendChild(organized);
        viewEvent.appendChild(DateTime);
        viewEvent.appendChild(location);
        if (event.description !== null) {
            let description = document.createElement("p");
            description.textContent = event.description;
            viewEvent.appendChild(description);
        }
        console.log(event)
        let invited = document.createElement("p");
        invited.textContent = "Invited: " + invitedName(event.invited);
        viewEvent.appendChild(invited);

        if (event.user.name === user.name) {
            viewEvent.appendChild(createCommandOrganiser(event));
        } else {
            viewEvent.appendChild(createCommandInvitee(event))
        }


        // if (event.slug) {
        //     let urlCode = "http://127.0.0.1:8000/" + event.slug
        //     let urlLink = document.createElement("button");
        //     urlLink.textContent = "Event URL";
        //     console.log(event.slug)
        //     viewEvent.appendChild(urlLink);  

        //     urlLink.addEventListener('click', function() {
        //         const urlToCopy = urlCode; // Change this to your desired URL
        //         navigator.clipboard.writeText(urlToCopy)
        //             .then(() => {
        //                 console.log('URL copied to clipboard:', urlToCopy);
        //                 alert('URL copied to clipboard!');
        //             })
        //             .catch(err => {
        //                 console.error('Error copying URL to clipboard: ', err);
        //                 alert('Failed to copy URL to clipboard. Please try again.');
        //             });
        //     });

        // }

    }

}


// let yourEvents = document.querySelectorAll(".yourevent");

// yourEvents.forEach(yourEvent => {
//     yourEvent.addEventListener('click', () => {
//         events.forEach(event => {
//             event.style.backgroundColor='white';
//         })

//         let data = yourEvent.getAttribute('data-variable');

//         console.log(data)
//         viewEvent(data);
//     })
// });


function createCommandOrganiser(event) {
    // Create the outer div element with class "commands" and id "organiser"
    const commandsDiv = document.createElement('div');
    commandsDiv.className = 'commands';
    commandsDiv.id = 'organiser';

    // Create the form element
    const formElement = document.createElement('form');
    formElement.action = '/invite/' + event.id; // Make sure to replace {{$urlEvent->id}} with the actual value
    formElement.method = 'POST';

    // Create the CSRF token input field
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken; // Make sure to replace this with the actual CSRF token

    // Create the input field for contact
    const contactInput = document.createElement('input');
    contactInput.type = 'text';
    contactInput.name = 'name';
    contactInput.placeholder = 'Invite contact';

    // Create the button element
    const inviteButton = document.createElement('button');
    inviteButton.textContent = 'Invite';

    // Append CSRF token input field, contact input field, and button to the form
    formElement.appendChild(csrfInput);
    formElement.appendChild(contactInput);
    formElement.appendChild(inviteButton);

    // Append the form to the commands div
    commandsDiv.appendChild(formElement);

    return commandsDiv
}

function createCommandInvitee(event) {
    // Create the outer div element with class "commands" and id "organiser"
    const commandsDiv = document.createElement('div');
    commandsDiv.className = 'commands';
    commandsDiv.id = 'invitee';

    // Create the form element
    const formElement = document.createElement('form');
    formElement.action = '/going/' + event.id; // Make sure to replace {{$urlEvent->id}} with the actual value
    formElement.method = 'POST';

    // Create the CSRF token input field
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}'; // Make sure to replace this with the actual CSRF token

    // Create the button element
    const inviteButton = document.createElement('button');
    inviteButton.textContent = 'Going';

    // Append CSRF token input field, contact input field, and button to the form
    formElement.appendChild(csrfInput);
    formElement.appendChild(inviteButton);

    // Append the form to the commands div
    commandsDiv.appendChild(formElement);

    return commandsDiv
}

