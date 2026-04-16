<?php
require "connect.php";

if (isset($_POST['titre']) && isset($_POST['description'])) {
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);

    if (empty($titre) || empty($description)) {
        header('Location: index.php?error=Veuillez remplir tous les champs');
        exit();
    }

    $tache = new Tache(null, $titre, $description);
    $tacheManager->add($tache);

    header('Location: index.php?message=La tâche a été ajoutée avec succès');
    exit();
}

header('Location: index.php?error=Informations manquantes');
exit();
?>
