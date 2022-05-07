<?php

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

echo hashPassword("RadjdBg");

?>