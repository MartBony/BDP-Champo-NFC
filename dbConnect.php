<?php
try
{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=nfchampo;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>