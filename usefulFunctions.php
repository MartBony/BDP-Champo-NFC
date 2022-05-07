<?php

function getSelector($tokenValidator, $selectorLength = 12){
	return substr($tokenValidator, 0, $selectorLength);
}

function hashPassword($password){
	return password_hash(
		base64_encode(
			hash('sha384', $password, true)
		),
		PASSWORD_BCRYPT
	);
}

function verifyPassword($input, $storedHash){
	return password_verify(base64_encode(hash('sha384', $input, true)), $storedHash);
}

function generateRandomString($length = 30) {
	return substr(bin2hex(random_bytes($length)) . "1111111111", 0, $length);
}

function generateToken($validity = 30, $selectorLength = 12, $validatorLength = 40){
	$selector = generateRandomString($selectorLength);
	$validator = $selector . generateRandomString($validatorLength-$selectorLength);
	$hashedValidator = hashPassword($validator);
	return array(
		'selector' => $selector,
		'validator' => $validator,
		'hashedValidator' => $hashedValidator,
		'expires' => time() + 60*60*24*$validity
	);
}
?>