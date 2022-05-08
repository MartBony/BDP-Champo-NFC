function fetcher(reqData){
	return fetch(reqData.url, {
		method: reqData.method,
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
		},
		body: new URLSearchParams(reqData.body || reqData.data),
	})
	.then(res => res.json());
}

let fetchBracelet = str => fetcher({
    method: 'POST',
    url: 'getbracelets.php',
    data: { bracelet: str }
});

let sodaObligatoire = number => number >= 5 && (number-5)%3 == 0;


//Connection

function activateUI(){
    document.getElementById("connection").style.display = "none";
    document.getElementById("content").style.display = "block";
    openView(0);
}

window.addEventListener("load", event => {
    fetcher({
        method: 'POST',
        url: "connection.php",
        data: {request : "tokenauth"}
    }).then(res => {
        if(res.allowed){
            activateUI();
        } else {
            throw("");
        }
    }).catch(() => {
        document.getElementById("connection").style.display = "flex";
    });
});


document.querySelector("#connection form").addEventListener("submit", event => {
    event.preventDefault();
    fetcher({
        method: 'POST',
        url: "connection.php",
        data: {request : "auth", user : "scanner", password: event.target.mainpassword.value}
    }).then(res => {
        if(res.allowed){
            activateUI();
        }
    });
});







// Fonctionnement de l'application

const views = Array.from(document.getElementsByTagName("main"));
var reading = false;
views[0].addEventListener("click", async event => {
    reading = true;
    try {
        const ndef = new NDEFReader();
        await ndef.scan();
        openView(1);


        ndef.addEventListener("readingerror", () => {
            views[0].innerHTML = "Echec"
        });

        ndef.addEventListener("reading", ({ message, serialNumber }) => {
            if(reading){
                reading = false;
                openView(2);
                fetchBracelet(serialNumber).then(res => {
                    openView(3);
                    drawResults(res.count);
                });
                console.log(message, serialNumber);
            }
        });
    } catch (error) {
        openView(4);
        console.log(error);
    }
});

document.querySelector("#resultsPage button").addEventListener("click", event => {
    reading = true;
    openView(1);
});

function drawResults(nombre){
    document.getElementById("super").innerHTML = nombre == 1 ? "er" : "ème";
    document.getElementById("nombre").innerHTML = nombre;
    document.getElementById("drinkType").innerHTML = sodaObligatoire(nombre) ? "sans" : "avec";
}

function openView(rank){
    views.forEach((view, id) => {
        if(id == rank){
            view.style.display = "flex";
        } else {
            view.style.display = "none";
        }
    });
}


