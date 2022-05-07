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



function drawResults(nombre){
    document.getElementById("nombre").innerHTML = nombre;
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

openView(0)