<?php 
require_once(__DIR__ .'/connectiondatabase.php'); 


/**
 * Condition d'ajout d'une classe et requête SQl de l'ajout de la classe
 */
if (isset($_POST['classe']) 
    && trim(($_POST['classe'])) 
    && !empty($_POST['classe'])
){

    $postclasse =$_POST['classe'] ;

    $insertionSQL= 'INSERT INTO classes(Nom_classe) VALUES(:Nom_classe)';
    $insertion_classe= $mysqlClient->prepare($insertionSQL);
    $insertion_classe->execute([
        'Nom_classe' => $postclasse
    ]);

}


/*
Reqûete SQl selectionnant toute les valeurs de la table classe
*/
$selectionSQL= 'SELECT * FROM classes';
$selection_classe= $mysqlClient->prepare($selectionSQL);
$selection_classe->execute();
$liste_classe=$selection_classe->fetchAll(); 
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
        <h1>Ajouter une classe</h1>

        <!-- Formulaitre d'ajout d'une classe -->
        <form action='classe.php' method='POST'>
            <label for='classe'>Classe</label>
            <input type='name' id='classe' name='classe' placeholder='ex: SIO1 A'/>
            <button type='submit'>ajouter</button>
        </form>

        <!-- Tableau regroupant les classes -->
        <h1>Liste des classe</h1>
        <table>
            <tr>
                <th>
                    <strong>ID</strong>
                </th>
                <th>
                    <strong>Libellé</strong>
                </th>
                <th>
                    <strong>Actions</strong>
                </th>       
            </tr>
            <?php for ($i=0; $i < count($liste_classe); $i++) { ?>
                <tr>
                    <td>
                        <?php echo $i+1 ?>
                    </td>
                    <td>
                        <?php echo $liste_classe[$i]['Nom_Classe'];?>
                    </td>
                        <!-- Formulaire pour la modification de la classe -->
                        <form method="POST" action="page_de_modification.php?type=classe">
                            <input type="hidden" name="id" value="<?php echo $liste_classe[$i]['Id']?>">
                            <input type="hidden" name="classe" value="<?php echo $liste_classe[$i]['Nom_Classe']?>">
                            <td>
                                <button type="submit" name="action">Éditer</button>
                            </td>
                        </form> 
                        
                        <!-- Formulaire pour la suppression de la classe -->
                        <form method="POST" action="suppression.php?type=classe">
                            <input type="hidden" name="id_classe" value="<?php echo $liste_classe[$i]['Id'] ?>">
                            <input type="hidden" name="nom_classe" value="<?php echo $liste_classe[$i]['Nom_Classe'] ?>">
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