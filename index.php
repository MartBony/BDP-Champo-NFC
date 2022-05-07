<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>BDP Champo NFC Tool</title>
</head>
<body>
    <main id="scanButton"><div class="circles"><span></span></div><h1>Taper pour scanner</h1></main>
    <main id="scanningPage"><div class="circles"><span></span><span></span><span></span></div><h1>En attente du scan</h1></main>
    <main id="waitingPage"><h1>En attente des résultats</h1></main>
    <main id="resultsPage"><h1><span id="nombre">0</span><span id="super">ème</span>verre</h1></main>
    <main id="errorPage"><h1>Operation Impossible (Ne fonctionne pas sur safari ou firefox)</h1></main>
    <script src="script.js"></script>
</body>
</html>