<?php
require_once(__DIR__ .'/connectiondatabase.php'); 
require_once(__DIR__ .'/header.php');


/*
Requête de suppression d'une matiere
*/
if ($_GET['type'] === 'matiere') {
    $deletematiere= $mysqlClient->prepare('DELETE FROM matieres WHERE Id = :Id');
    $deletematiere->execute([
        'Id' => $_POST['id_matiere'],
    ]);
?>
<h3>La matière <?php echo $_POST['nom_matiere']?> a bien été supprimer</h3>
<?php }?>


<!-- Requête de suppression d'une classe -->
<?php if ($_GET['type'] === 'classe') {
    $deleteclasse= $mysqlClient->prepare('DELETE FROM classes WHERE Id = :Id');
    $deleteclasse->execute([
        'Id' => $_POST['id_classe'],
    ]);
?>
<h3>La classe <?php echo $_POST['nom_classe']?> a bien été supprimer</h3>
<?php }?>


<!-- Requête de suppression d'un élève -->
<?php if ($_GET['type'] === 'eleve') {
    $deleteclasse= $mysqlClient->prepare('DELETE FROM eleves WHERE Id = :Id');
    $deleteclasse->execute([
        'Id' => $_POST['id_eleve'],
    ]);
?>
<h3>L'élève <?php echo $_POST['nom_eleve']." ".$_POST['prenom_eleve']." ". 'en classe'." ".$_POST['classe_eleve']?> a bien été supprimer.</h3>
<?php }?> 


<!-- Requête de suppression d'une note -->
<?php if ($_GET['type'] === 'note') {
    $deleteclasse= $mysqlClient->prepare('DELETE FROM notes WHERE Id = :Id');
    $deleteclasse->execute([
        'Id' => $_POST['id_note'],
    ]);
?>
<h3>La note en <?php echo $_POST['nom_matiere'] ;?> de l'élève <?php echo $_POST['nom_eleve']." ".$_POST['prenom_eleve']?> a bien été supprimer.</h3>
<?php }?> 

<?php
require_once(__DIR__ .'/footer.php') 
?>
</body>
</html>