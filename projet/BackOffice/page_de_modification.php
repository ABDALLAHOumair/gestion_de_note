<?php
require_once(__DIR__ .'/header.php');
require_once(__DIR__ .'/connectiondatabase.php');

$selectionSQL= 'SELECT * FROM classes';
$selection_classe= $mysqlClient->prepare($selectionSQL);
$selection_classe->execute();
$liste_classe=$selection_classe->fetchAll(); 

if ($_GET['type'] === 'matiere') {
?>
    <h1>Modification de la matière</h1>
    <form action="application_de_modification.php?type=matiere" method="POST">
        <input type="hidden" name="id_matiere" value="<?php echo $_POST['id_matiere']?>">
        <label>Matiere: </label>
        <input id='matiere' name='nouvelle_matiere' value=<?php echo $_POST['nom_matiere']?>>
        <button type='submit'>appliquer</button>
    </form><br>
<?php } ?>


<?php if ($_GET['type'] === 'classe') { ?>
    <h1>Modification de la classe</h1>
    <form action="application_de_modification.php?type=classe" method="POST">
        <input type="hidden" name="id" value="<?php echo $_POST['id']?>">
        <label>Classe: </label>
        <input id='classe' name='nouvelle_classe' value=<?php echo $_POST['classe']?>>
        <button type='submit'>appliquer</button>
    </form><br>
<?php } ?>


<?php if ($_GET['type'] === 'eleve') { ?>
    <h1>Modification de l'élève</h1>
    <form action="application_de_modification.php?type=eleve" method="POST">
        <input type="hidden" name="id" value="<?php echo $_POST['id_eleve']?>">
        <label>Nom: </label>
        <input id='nom' name='nouveau_nom' value=<?php echo $_POST['nom_eleve']?>>
        <label>Prenom: </label>
        <input id='prenom' name='nouveau_prenom' value=<?php echo $_POST['prenom_eleve']?>>
        <label>Classe: </label>
        <select name='classe'>
            <?php for ($i=0; $i < count($liste_classe); $i++) {;?>
                <option value="<?php echo $liste_classe[$i]['Id'] ?>" <?php if ($liste_classe[$i]['Nom_Classe']==$_POST['classe_eleve']){?>selected<?php }?>><?php echo $liste_classe[$i]['Nom_Classe'] ?></option>
            <?php };?>
        </select>
        <button type='submit'>appliquer</button>
    </form><br>
<?php } ?>

<?php if ($_GET['type'] === 'note') {
?>
    <h1>Modification de la note</h1>
    <form action="application_de_modification.php?type=note" method="POST">
        <input type="hidden" name="id_note" value="<?php echo $_POST['id_note']?>">
        <label>Nom: </label>
        <input value=<?php echo $_POST['nom_eleve']?> disabled>
        <label>Prenom: </label>
        <input value=<?php echo $_POST['prenom_eleve']?> disabled>
        <label>Note: </label>
        <input type="number" id='note' name='nouvelle_note' value=<?php echo $_POST['note']?> min="0" max="20"/>
        <label>Date: </label>
        <input value=<?php echo $_POST['date']?> disabled>
        <button type='submit'>appliquer</button>
    </form><br>
<?php } ?>

<?php
require_once(__DIR__ .'/footer.php');
?>
</body>
</html>