<?php 
require_once(__DIR__ .'/header.php');
require_once(__DIR__ .'/connectiondatabase.php'); 

if (isset($_POST['note']) 
    && isset($_POST['date']) 
    && isset($_POST['eleve']) 
    && isset($_POST['matiere']) 
    && !empty($_POST['note']) 
    && !empty($_POST['date']) 
    && !empty($_POST['eleve']) 
    && !empty($_POST['matiere'])){

    $insertnote= 'INSERT INTO notes(Note, Date, Id_Eleve, Id_Matiere) VALUES(:Note, :La_Date, :Id_Eleve, :Id_Matiere)';
    $insertion_matiere= $mysqlClient->prepare($insertnote);
    $insertion_matiere->execute([
        'Note' => $_POST['note'],
        'La_Date' => $_POST['date'],
        'Id_Eleve' => $_POST['eleve'],
        'Id_Matiere' => $_POST['matiere'],
    ]);
}

$selectnote= 'SELECT elv.Nom, elv.Prenom, nte.Id, nte.Note, mtr.Nom_Matiere, Date
FROM notes nte
JOIN eleves elv ON nte.Id_Eleve = elv.Id
JOIN matieres mtr ON nte.Id_Matiere	= mtr.Id';
$selection_note= $mysqlClient->prepare($selectnote);
$selection_note->execute();
$liste_notes=$selection_note->fetchAll();

$selecteleve= 'SELECT elv.Id, cls.Nom_Classe, elv.Nom, elv.Prenom FROM eleves elv
JOIN classes cls ON elv.Id_Classe=cls.Id';
$selection_eleve= $mysqlClient->prepare($selecteleve);
$selection_eleve->execute();
$liste_eleves=$selection_eleve->fetchAll();

$selectmatiere= 'SELECT * FROM matieres';
$selection_matiere= $mysqlClient->prepare($selectmatiere);
$selection_matiere->execute();
$liste_matiere=$selection_matiere->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <style>
      table,
      th,
      td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>
</head>
<body>
    <div>
        <?php require_once(__DIR__ .'/header.php');?>
        <h1>Ajouter une note</h1>

        <form action='note.php' method='post'>
            <label for='eleve'>Elève</label>
            <select name='eleve'>
                <?php for ($i=0; $i < count($liste_eleves); $i++) { ?>
                    <option value=<?php echo $liste_eleves[$i]['Id']?>><?php echo $liste_eleves[$i]['Nom'], $liste_eleves[$i]['Prenom'] ?> </option>
                <?php } ?>    
            </select>
            <label for='matiere'>Matière</label>
            <select name='matiere'>
                <?php for ($i=0; $i < count($liste_matiere); $i++) { ?>
                    <option value=<?php echo $liste_matiere[$i]['Id']?>><?php echo $liste_matiere[$i]['Nom_Matiere'] ?> </option>
                <?php } ?> 
            </select>
            <label for='note'>Note</label>
            <input type='number' name='note' min='0' max='20'/>
            </select>
            <label for='date'>Date</label> 
            <input type='date' name='date'/>
            <button type='submit'>ajouter</button>
        </form>
        <h1>Liste des notes</h1>
        <table>
            <tr>
                <td>
                    <strong>Id</strong>
                </td>
                <td>
                    <strong>Élève</strong>
                </td>
                <td>
                    <strong>Matière</strong>
                </td>
                <td>
                    <strong>Note</strong>
                </td>
                <td>
                    <strong>Date</strong>
                </td>
                <td>
                    <strong>Actions</strong>
                </td>
            </tr>
            <?php for ($i=0; $i < count($liste_notes); $i++) { ?>
                <tr>
                    <td>
                        <?php echo $i+1 ?>
                    </td>
                    <td>
                        <?php echo $liste_notes[$i]['Nom'].' '. $liste_notes[$i]['Prenom'];?>
                    </td>
                    <td>
                        <?php echo $liste_notes[$i]['Nom_Matiere']?>
                    </td>
                    <td>
                        <?php echo $liste_notes[$i]['Note'];?>
                    </td>
                    <td>
                        <?php echo $liste_notes[$i]['Date'];?>
                    </td>
                        <form method="POST" action="page_de_modification.php?type=note">
                            <input type="hidden" name="id_note" value="<?php echo $liste_notes[$i]['Id']?>">
                            <input type="hidden" name="nom_eleve" value="<?php echo $liste_notes[$i]['Nom']?>">
                            <input type="hidden" name="prenom_eleve" value="<?php echo $liste_notes[$i]['Prenom']?>">
                            <input type="hidden" name="nom_matiere" value="<?php echo $liste_notes[$i]['Nom_Matiere']?>">
                            <input type="hidden" name="note" value="<?php echo $liste_notes[$i]['Note']?>">
                            <input type="hidden" name="date" value="<?php echo $liste_notes[$i]['Date']?>">
                            <td>
                                <button type="submit" name="action">Éditer</button>
                            </td>
                        </form>   
                        <form method="post" action="suppression.php?type=note">
                            <input type="hidden" name="id_note" value="<?php echo $liste_notes[$i]['Id'] ?>">
                            <input type="hidden" name="nom_matiere" value="<?php echo $liste_notes[$i]['Nom_Matiere'] ?>">
                            <input type="hidden" name="nom_eleve" value="<?php echo $liste_notes[$i]['Nom'] ?>">
                            <input type="hidden" name="prenom_eleve" value="<?php echo $liste_notes[$i]['Prenom'] ?>">
                            <td>
                                <button type="submit" name="action">Supprimer</button>
                            </td>
                        </form>
                </tr>
            <?php } ;?>
        </table><br>
    </div>
<?php
require_once(__DIR__ .'/footer.php') 
?>
</body>
</html>