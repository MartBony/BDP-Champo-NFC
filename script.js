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