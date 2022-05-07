<?php

require_once("usefulFunctions.php");



if($_POST["request"] && $_POST["request"] == "auth" && $_POST["user"] && $_POST["password"]){

	$usersFile = "./secure/users.json";
	$usersJson = json_decode(file_get_contents($usersFile),TRUE);

	$allowed = false;

	$reqProfile = array_filter($usersJson, function($profile){return $_POST["user"] == $profile["id"] && verifyPassword($_POST["password"], $profile["mdp"]);});
	
	if(sizeof($reqProfile) >= 1){
		$profile = array_pop($reqProfile);
		$token = generateToken();

		
		$tokensFile = "./secure/tokens.json";
		$tokensJson = json_decode(file_get_contents($tokensFile),TRUE);

		array_push($tokensJson, $token);
		file_put_contents($tokensFile, json_encode($tokensJson));

		setcookie("identificationToken", $token['validator'], array(
			'expires' => $token['expires'],
			'path' => '',
			'secure' => true,
			'samesite' => 'strict',
			'httponly' => true
		));

		$allowed = true;

	}

	echo json_encode(array(
		"allowed" => $allowed
	));

} else if ($_POST["request"] && $_POST["request"] == "tokenauth") {
	require_once("tokensReader.php");
	$allowed = login(true);

	echo json_encode(array(
		"allowed" => $allowed
	));
}


?>