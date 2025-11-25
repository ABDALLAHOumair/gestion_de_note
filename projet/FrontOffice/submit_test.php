<?php 
require_once(__DIR__.'/variables.php')
?>

<?php
echo "Voici les notes de". $eleves[$_GET['eleve']];
foreach ($etudiants as $etudiant){
    if ($_GET['eleve'] == $etudiant['id']){
        echo $etudiant['classe'];
    }
} 
;?>