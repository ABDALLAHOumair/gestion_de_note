<?php
 $get_eleve = $_GET;

require_once(__DIR__.'/variables.php')
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
    <form action="submit_test.php" method="GET">
        <label>Veuillez selectionner l'élève que vous souhaitez voir ses notes:
        <select name="eleve">
            <?php for ($i=0 ; $i < count($eleves) ; $i++){ ?>
                <option value="<?php echo $i ;?>"><?php echo $eleves[$i] ;?></option>
            <?php };?>
        <input type="submit" value="actualiser" />
    </form>
    </select>
    </label>

</body>
</html>
<?php if (!isset($_GET['eleve'])){
    if ($i==$_GET['eleve']){
        selected }}?>

 