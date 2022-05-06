const scanbutton = document.getElementById("scanButton");

scanbutton.addEventListener("click", async event => {
    scanbutton.innerHTML = "scanning"
    try {
        const ndef = new NDEFReader();
        await ndef.scan();

        ndef.addEventListener("readingerror", () => {
            scanbutton.innerHTML = "Echec"
        });

        ndef.addEventListener("reading", ({ message, serialNumber }) => {
            scanbutton.innerHTML = "scan réussi"
            console.log(message, serialNumber);
        });
    } catch (error) {
        console.log(error);
    }
});

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
}).then(res => {
    console.log(res);
});;

fetchBracelet("uzegf");