<?php 
require_once(__DIR__ .'/header.php');
require_once(__DIR__ .'/connectiondatabase.php'); 

if (isset($_POST['prenom_eleve']) 
    && ($_POST['nom_eleve']) 
    && ($_POST['classe']) 
    && !empty($_POST["prenom_eleve"]) 
    && !empty($_POST["nom_eleve"]) 
    && !empty($_POST["classe"])
){
     
    $inserteleve= 'INSERT INTO eleves(Nom, Prenom, Id_Classe) VALUES(:Nom, :Prenom, :Id_Classe)';
    $insertion_eleve= $mysqlClient->prepare($inserteleve);
    $insertion_eleve->execute([
        'Nom' => $_POST['nom_eleve'],
        'Prenom' => $_POST['prenom_eleve'],
        'Id_Classe' => $_POST['classe']
    ]);

}

$selecteleve= 'SELECT elv.Id,cls.Nom_Classe, elv.Nom, elv.Prenom FROM eleves elv
JOIN classes cls ON elv.Id_Classe=cls.Id';
$selection_eleve= $mysqlClient->prepare($selecteleve);
$selection_eleve->execute();
$liste_eleves=$selection_eleve->fetchAll();

$selectclasse= 'SELECT * FROM classes';
$selection_classe= $mysqlClient->prepare($selectclasse);
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
        <h1>Ajouter un élève</h1>
        <form action='eleve.php' method='POST'>
            <label for='prenom'>Prénom</label>
            <input type='name' id='prenom' name='prenom_eleve' placeholder='ex: Alice'>
            <label for='nom'>Nom</label>
            <input type='texte' id='nom' name='nom_eleve' placeholder='ex: Durand'>
            <label for='classe'>Classe</label>
            <select name='classe'>
                <?php for ($i=0; $i < count($liste_classe); $i++) {;?>
                    <option value=<?php echo $liste_classe[$i]['Id'] ?>><?php echo $liste_classe[$i]['Nom_Classe'] ?></option>
                <?php };?>
            </select>
            <button type='submit'>Ajouter</button>
        </form>
        <h1>Liste des élève</h1>
        <table>
            <tr>
                <td>
                    <strong>ID</strong>
                </td>
                <td>
                    <strong>Nom</strong>
                </td>
                <td>
                    <strong>Prénom</strong>
                </td>
                <td>
                    <strong>Classe</strong>
                </td>
                <td>
                    <strong>Actions</strong>
                </td>
            </tr>
            <?php for ($i=0; $i < count($liste_eleves); $i++) { ?>
                <tr>
                    <td>
                        <?php echo $i+1 ?>
                    </td>
                    <td>
                        <?php echo $liste_eleves[$i]['Nom'];?>
                    </td>
                    <td>
                        <?php echo $liste_eleves[$i]['Prenom'];?>
                    </td>
                    <td>
                        <?php echo $liste_eleves[$i]['Nom_Classe'];?>
                    </td>
                        <form method="POST" action="page_de_modification.php?type=eleve">
                            <input type="hidden" name="id_eleve" value="<?php echo $liste_eleves[$i]['Id']?>">
                            <input type="hidden" name="nom_eleve" value="<?php echo $liste_eleves[$i]['Nom']?>">
                            <input type="hidden" name="prenom_eleve" value="<?php echo $liste_eleves[$i]['Prenom']?>">
                            <input type="hidden" name="classe_eleve" value="<?php echo $liste_eleves[$i]['Nom_Classe']?>">
                            <td>
                                <button type="submit" name="action">Éditer</button>
                            </td>
                        </form>   
                        <form method="POST" action="suppression.php?type=eleve">
                            <input type="hidden" name="id_eleve" value="<?php echo $liste_eleves[$i]['Id']?>">
                            <input type="hidden" name="nom_eleve" value="<?php echo $liste_eleves[$i]['Nom']?>">
                            <input type="hidden" name="prenom_eleve" value="<?php echo $liste_eleves[$i]['Prenom']?>">
                            <input type="hidden" name="classe_eleve" value="<?php echo $liste_eleves[$i]['Nom_Classe']?>">
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