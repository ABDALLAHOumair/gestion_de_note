<?php 

require_once(__DIR__ .'/connectiondatabase.php');


/*
 Condition d'ajout d'une matiere et requête SQl de l'ajout d'une matiere
 */
if (isset($_POST['matiere']) 
    && trim($_POST['matiere']) 
    && !empty($_POST['matiere'])
){

    $insertmatiere= 'INSERT INTO matieres(Nom_Matiere) VALUES(:Nom_Matiere)';
    $insertion_matiere= $mysqlClient->prepare($insertmatiere);
    $insertion_matiere->execute([
        'Nom_Matiere' => $_POST['matiere'],
    ]);

}


/*
 Requête SQl selectionnant toute les valeurs de la table matiere
 */
$selectionSQL= 'SELECT * FROM matieres';
$selection_matiere= $mysqlClient->prepare($selectionSQL);
$selection_matiere->execute();
$liste_matiere=$selection_matiere->fetchAll();


require_once(__DIR__ .'/header.php');
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
        <h1>Ajouter une matière</h1>

        <!-- Formulaitre d'ajout d'une matiere -->
        <form action='matiere.php' method='POST'>
            <label for='matiere'>Libellé</label>
            <input id='matiere' name='matiere' placeholder='ex: Math'/>
            <button type='submit'>ajouter</button>
        </form>

        <!-- Tableau regroupant les matières -->
        <h1>Liste des matière</h1>
        <table>
            <tr>
                <td>
                    <strong>ID</strong>
                </td>
                <td>
                    <strong>Libellé</strong>
                </td>
                <td>
                    <strong>Actions</strong>
                </td>
            </tr>
                <?php for ($i=0; $i < count($liste_matiere); $i++) { ?>
                    <tr>
                        <td>
                            <?php echo $i+1;?>
                        </td>
                        <td>
                            <?php echo $liste_matiere[$i]['Nom_Matiere'];?>
                        </td>
                        <td>
                            <!-- Formulaire pour la modification de la matiere -->
                            <form method="POST" action="page_de_modification.php?type=matiere">
                                <input type="hidden" name="id_matiere" value="<?php echo $liste_matiere[$i]['Id']?>">
                                <input type="hidden" name="nom_matiere" value="<?php echo $liste_matiere[$i]['Nom_Matiere']?>">
                                <td>
                                    <button type="submit" name="action">Éditer</button>
                                </td>
                            </form>  
                            
                            <!-- Formulaire pour la suppression de la matiere -->
                            <form method="POST" action="suppression.php?type=matiere">
                                <input type="hidden" name="id_matiere" value="<?php echo $liste_matiere[$i]['Id'] ?>">
                                <input type="hidden" name="nom_matiere" value="<?php echo $liste_matiere[$i]['Nom_Matiere'] ?>">
                                <td>
                                    <button type="submit" name="action">Supprimer</button>
                                </td>
                            </form>
                        </td>
                    </tr>
                <?php } ;?>
        </table><br>
    </div>                
<?php
require_once(__DIR__ .'/footer.php') 
?>
</body>
</html>