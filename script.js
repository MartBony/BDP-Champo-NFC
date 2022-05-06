document.getElementById("scanButton").addEventListener("click", async event => {
    event.currentTarget.innerHTML = "scanning"
    try {
        const ndef = new NDEFReader();
        await ndef.scan();

        ndef.addEventListener("readingerror", () => {
            console.log("Cannot read data from the NFC tag. Try another one?");
        });

        ndef.addEventListener("reading", ({ message, serialNumber }) => {
            console.log(message, serialNumber);
        });
    } catch (error) {
        console.log(error);
    }
});