<?php

/* On va stocker les données dans un fichier JSON :

$json = json_decode(file_get_contents($file),TRUE);

$json[$user] = array("first" => $first, "last" => $last);

file_put_contents($file, json_encode($json));

*/
header("Content-Type: application/json");

$data = $_POST['bracelet'];
$file = "./secure/databracelets.json";

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

/* echo json_encode(array(
    'status' => 200,
    'payload' => array(
        'id' => (int) $course['id'],
        'nom' => $course['nom'],
        'maxPrice' => (float) $course['maxPrice'],
        'total' => $total,
        'dateStart' => (int) $course['dateStart'],
        'groupe' => (int) $course['groupe'],
        'taxes' => (float) $course['taxes'],
        'items' => array(
            'articles' => $articles,
            'previews' => $previews
        )
    )
));	 */

?>