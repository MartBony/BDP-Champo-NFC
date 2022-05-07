<?php

/* On va stocker les données dans un fichier JSON :

$json = json_decode(file_get_contents($file),TRUE);

$json[$user] = array("first" => $first, "last" => $last);

file_put_contents($file, json_encode($json));

*/
header("Content-Type: application/json");

require_once("tokensReader.php");

if(login()){

    $data = $_POST['bracelet'];
    $file = "./secure/bracelets.json";

    $json = json_decode(file_get_contents($file),TRUE);

    if($json[$data]){
        $json[$data] += 1;
        $res = $json[$data];
    } else {
        $json[$data] = 1;
    }

    file_put_contents($file, json_encode($json));

    echo json_encode(array(
        'count' => $json[$data]
    ));

}
?>