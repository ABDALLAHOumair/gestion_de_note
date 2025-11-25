<?php

require_once ('/xampp/htdocs/projet/BackOffice/connectiondatabase.php');


/*
Requête SQl selectionnant le nom, prenom, le note, la classe et la matiere de la table notes et faisant la jointure avec les tables eleves, matieres et classes 
*/
$selectnote= 'SELECT elv.Nom, elv.Prenom,nte.Note,nte.Id_Eleve, mtr.Nom_Matiere, cls.Nom_Classe, Date
FROM notes nte
JOIN eleves elv ON nte.Id_Eleve = elv.Id
JOIN classes cls ON elv.Id_Classe=cls.Id
JOIN matieres mtr ON nte.Id_Matiere	= mtr.Id';
$selection_note= $mysqlClient->prepare($selectnote);
$selection_note->execute();
$liste_notes=$selection_note->fetchAll();


/*
Requête SQl selectionnant le nom, prenom, et la calsse de la table notes et faisant la jointure avec la table classes
*/
$selecteleve= 'SELECT elv.Id,cls.Nom_Classe, elv.Nom, elv.Prenom FROM eleves elv
JOIN classes cls ON elv.Id_Classe=cls.Id';
$selection_eleve= $mysqlClient->prepare($selecteleve);
$selection_eleve->execute();
$liste_eleves=$selection_eleve->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partage de note</title>
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
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="eleve.php">Eleves</a></li>
        </ul>
    </nav>

    <!-- Formulaire de selection d'un élève -->
    <form action="eleve.php" method="post">
        <label>Veuillez selectionner l'élève que vous souhaitez voir ses notes:
        <select name='eleve'>
            <?php for ($i=0 ; $i < count($liste_eleves) ; $i++){ ?>
                <option value="<?php echo $liste_eleves[$i]['Id']?>" <?php if(isset($_POST['eleve'])){ if ($liste_eleves[$i]['Id']==$_POST['eleve']){?>selected<?php }}?>><?php echo $liste_eleves[$i]['Nom'].' '.$liste_eleves[$i]['Prenom'] ;?></option>
            <?php } ;?>
        <input type="submit" value="actualiser" />
    </form>
    </select>
    </label><br>
        <?php if (!isset($_POST['eleve'])){
            echo "veuillez choisir un étudiant";
            }

            else {
            ?>

            <!-- Tableau regroupant les notes de l'élève -->
            <table>
                <tr> 
                    <th>Classe</th>
                    <th>Matière</th>
                    <th>Note</th>
                    <th>Date</th>
                </tr>
                <?php
                for ($i=0; $i < count($liste_notes); $i++) {
                    if ($_POST['eleve'] == $liste_notes[$i]['Id_Eleve']){ ;?>
                        <tr>
                            <td>
                                <?php echo $liste_notes[$i]['Nom_Classe'];?>
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
                        </tr>
                    <?php }
    
                }
            }?>
            </table>
</body>
</html>
