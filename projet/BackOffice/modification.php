<?php
require_once(__DIR__ .'/connectiondatabase.php');
require_once(__DIR__ . '/fonction.php');

$updatematiere=$mysqlClient->prepare('UPDATE matieres SET Nom_Matiere=:Nom_Matiere WHERE Id=:Id');
$updatematiere->execute([
    'Nom_Matiere' => $_GET['nouvelle'],
    'Id'=> $_GET['id'],
]);


redirectToUrl('matiere.php');
?>