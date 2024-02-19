<?php 
      
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=matrix_invit;charset=utf8", "root", "");
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
