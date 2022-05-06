document.getElementById("scanButton").addEventListener("click", async event => {
    event.currentTarget.innerHTML = "scanning"
    try {
        const ndef = new NDEFReader();
        await ndef.scan();

        ndef.addEventListener("readingerror", () => {
            event.currentTarget.innerHTML = "Echec"
        });

        ndef.addEventListener("reading", ({ message, serialNumber }) => {
            event.currentTarget.innerHTML = "scan réussi"
            console.log(message, serialNumber);
        });
    } catch (error) {
        console.log(error);
    }
});