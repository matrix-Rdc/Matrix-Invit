<?php 
//connexion à la base de données
$dbhost='localhost';
$dbname='bddinvit';
$dbuser='root';
$password='';
try {
	$cnx_bdd= new PDO('mysql:host='.$dbhost.';dbname='.$dbname,$dbuser,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
} catch (PDOException $e) {
	die("erreur de connexion");
}
 ?>