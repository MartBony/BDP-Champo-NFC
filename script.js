const views = Array.from(document.getElementsByTagName("main"));
var reading = false;
views[0].addEventListener("click", async event => {
    reading = true;
    openView(1);
    try {
        const ndef = new NDEFReader();
        await ndef.scan();


        ndef.addEventListener("readingerror", () => {
            views[0].innerHTML = "Echec"
        });

        ndef.addEventListener("reading", ({ message, serialNumber }) => {
            if(reading){
                reading = false;
                openView(0);
                views[0].innerHTML = "scan réussi"
                fetchBracelet(serialNumber).then(res => {
                    views[0].innerHTML = "Vous avez bu " + res.count + " fois"
                });
                console.log(message, serialNumber);
            }
        });
    } catch (error) {
        views[0].innerHTML = "Navigateur non compatible, utiliser chrome sur android"
        console.log(error);
    }
});




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

fetchBracelet("uzegf");