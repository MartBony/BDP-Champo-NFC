<?php

require_once("usefulFunctions.php");


function login($modify = false){ // Rewite responses

	$tokensFile = "./secure/tokens.json";
	$tokensJson = json_decode(file_get_contents($tokensFile),TRUE);
	
	if(isset($_COOKIE['identificationToken'])){
		$validator = $_COOKIE['identificationToken'];
		$selector = getSelector($validator);

	/* 	$reqToken = $bdd->prepare('SELECT * FROM `tokens` WHERE `selector` = ?');
		$reqToken->execute(array($selector)); */

        $reqToken = array_filter($tokensJson, function($token) use ($selector) {return $token["selector"] == $selector;});


		if(sizeof($reqToken) >= 1){
			$token = array_pop($reqToken);

			if(time() < $token['expires'] && verifyPassword($validator, $token['hashedValidator'])){
				
				if($modify){
					$token = generateToken();
					// On enlève le token précédent
					$updatedTokensJson = array_filter($tokensJson, function($token) use ($selector){return $token["selector"] != $selector;});

					array_push($updatedTokensJson, $token);
					file_put_contents($tokensFile, json_encode($updatedTokensJson));

					setcookie("identificationToken", $token['validator'], array(
						'expires' => $token['expires'],
						'path' => '',
						'secure' => true,
						'samesite' => 'strict',
						'httponly' => true
					));
				}

				return true;
			} else {
				echo json_encode(array('status' => 401, 'action' => 'authenticate', 'payload' => array('type' => 'MSG', 'message' => "Pour votre sécurité, connectez-vous de nouveau")));
				return false;
			}

		} else {
			echo json_encode(array('status' => 401, 'action' => 'authenticate', 'payload' => array('type' => 'ERROR', 'message' => "Nous n'arrivons pas à vous identifier, connectez-vous de nouveau.")));
			return false;
		}
		
	} else {
		echo json_encode(array('status' => 401, 'action' => 'authenticate', 'payload' => array('type' => 'ERROR', 'message' => "Nous n'arrivons pas à vous identifier, activez vos cookies et connectez-vous de nouveau.")));
		return false;
	}

}

?>