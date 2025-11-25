<?php 
require_once(__DIR__ .'/header.php')
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <div>
        <?php require_once(__DIR__ .'/header.php');?>
        <h1>Tableau de bord</h1>
        <div>
            <p>Choissisez une sectino à gérer :</p>
            <nav>
                <ul>
                    <li><a href="classe.php">Gérer les classes</a></li>
                    <li><a href="eleve.php">Gérer les élèves</a></li>
                    <li><a href="matiere.php">Gérer les matièeres</a></li>
                    <li><a href="note.php">Gérer les notes</a></li>
                </ul>
            </nav>
        </div> 
    </div>
<?php
require_once(__DIR__ .'/footer.php') 
?>
</body>
</html>