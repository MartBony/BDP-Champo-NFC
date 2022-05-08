<?php
	// Require https
	/* 

        A mettre dans Htaccess

    RewriteEngine On
    RewriteCond %{HTTP:X-Forwarded-Proto} =http [OR]
    RewriteCond %{HTTP:X-Forwarded-Proto} =""
    RewriteCond %{HTTPS} !=on
    RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>BDP Champo NFC Tool</title>
</head>
<body>
    <div id="signal"></div>
    <section id="connection">
        <form action="">
            <input name="mainpassword" type="password">
            <input type="submit" value="Vérifier son identité">
        </form>
    </section>
    <section id="content">
        <main id="scanButton"><div class="circles"><span></span></div><h1>Taper pour scanner</h1></main>
        <main id="scanningPage"><div class="circles"><span></span><span></span><span></span></div><h1>Scannez maintenant</h1></main>
        <main id="waitingPage"><h1>En attente des résultats</h1></main>
        <main id="resultsPage"><h1><span id="nombre">0</span><span id="super">ème</span> verre</h1><p>Servir une boisson <span id="drinkType">sans alcool</span></p><button>Scanner de nouveau</button></main>
        <main id="errorPage"><h1>Operation Impossible (Ne fonctionne pas sur safari ou firefox)</h1></main>
        <script src="script.js"></script>
    </section>
</body>
</html>