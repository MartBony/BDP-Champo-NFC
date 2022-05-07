const scanbutton = document.getElementById("scanButton");
const views = Array.from(document.getElementsByTagName("main"));

scanbutton.addEventListener("click", async event => {
    openView(1);
    try {
        const ndef = new NDEFReader();
        await ndef.scan();

        ndef.addEventListener("readingerror", () => {
            scanbutton.innerHTML = "Echec"
        });

        ndef.addEventListener("reading", ({ message, serialNumber }) => {
            scanbutton.innerHTML = "scan réussi"
            fetchBracelet(serialNumber).then(res => {
                scanbutton.innerHTML = "Vous avez bu " + res.count + " fois"
            });
            console.log(message, serialNumber);
        });
    } catch (error) {
        scanbutton.innerHTML = "Navigateur non compatible, utiliser chrome sur android"
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