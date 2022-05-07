<?php

// Require https
if ((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") && $_SERVER['SERVER_NAME'] != "localhost") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url", true, 301);
    exit;
}

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
    <main id="scanButton"><span></span></main>
    <script src="script.js"></script>
</body>
</html>