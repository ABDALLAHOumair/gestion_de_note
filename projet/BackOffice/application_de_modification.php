<?php
require_once(__DIR__ .'/connectiondatabase.php');
require_once(__DIR__ . '/fonction.php');

if ($_GET['type'] === 'matiere') {
    if (isset($_POST['nouvelle_matiere']) && trim($_POST['nouvelle_matiere']) && !empty($_POST['nouvelle_matiere'])){
    $updatematiere=$mysqlClient->prepare('UPDATE matieres SET Nom_Matiere=:Nom_Matiere WHERE Id=:Id');
    $updatematiere->execute([
        'Nom_Matiere' => $_POST['nouvelle_matiere'],
        'Id'=> $_POST['id_matiere'],
    ]);
    }
    redirectToUrl('matiere.php');
}

elseif ($_GET['type'] === 'classe') {
    if (isset($_POST['nouvelle_classe']) && trim($_POST['nouvelle_classe']) && !empty($_POST['nouvelle_classe'])){
    $updateclasse=$mysqlClient->prepare('UPDATE classes SET Nom_Classe=:Nom_Classe WHERE Id=:Id');
    $updateclasse->execute([
        'Nom_Classe' => $_POST['nouvelle_classe'],
        'Id'=> $_POST['id'],
    ]);
    }
    redirectToUrl('classe.php');
}

elseif ($_GET['type'] === 'eleve') {
    if ((isset($_POST['nouveau_nom']) && trim($_POST['nouveau_nom']) && !empty($_POST['nouveau_nom'])) && (isset($_POST['nouveau_prenom']) && trim($_POST['nouveau_prenom']) && !empty($_POST['nouveau_prenom']))){
    $updateeleve=$mysqlClient->prepare('UPDATE eleves SET Nom=:Nom, Prenom=:Prenom, Id_Classe=:Classe WHERE Id=:Id');
    $updateeleve->execute([
        'Nom' => $_POST['nouveau_nom'],
        'Prenom' => $_POST['nouveau_prenom'],
        'Classe' => $_POST['classe'],
        'Id'=> $_POST['id'],
    ]);
    }
    redirectToUrl('eleve.php');
}

elseif ($_GET['type'] === 'note') {
    if (isset($_POST['nouvelle_note']) && trim($_POST['nouvelle_note']) && !empty($_POST['nouvelle_note'])){
    $updatenote=$mysqlClient->prepare('UPDATE notes SET Note=:Note WHERE Id=:Id');
    $updatenote->execute([
        'Note'=> $_POST['nouvelle_note'],
        'Id'=> $_POST['id_note'],
    ]);
    }
    redirectToUrl('note.php');
}
?>