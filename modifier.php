<?php
require "connect.php";

$error = '';
$task_id = intval($_GET['task_id'] ?? 0);
$tache = $tacheManager->getById($task_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = intval($_POST['task_id'] ?? 0);
    $titre = trim($_POST['modif_titre'] ?? '');
    $description = trim($_POST['modif_desk'] ?? '');

    if ($task_id === 0 || $titre === '' || $description === '') {
        $error = 'Tous les champs doivent être remplis.';
    } else {
        $tache = new Tache($task_id, $titre, $description);
        $tacheManager->update($tache);
        header('Location: index.php?message=Tâche modifiée avec succès');
        exit();
    }
}

if (!$tache) {
    header('Location: index.php?error=Tâche introuvable');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Tâche</title>
    <link rel="stylesheet" href="stylemodifier.css">
</head>
<body>
    <h1>Modifier une Tâche</h1>

    <?php if ($error): ?>
        <div style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div>
    <?php endif; ?>

    <form action="modifier.php" method="POST">
        <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($tache->getId(), ENT_QUOTES); ?>">

        <label for="modif_titre">Titre :</label>
        <input type="text" id="modif_titre" name="modif_titre" value="<?php echo htmlspecialchars($tache->getTitre(), ENT_QUOTES); ?>" placeholder="Entrez le nouveau titre" required>

        <label for="modif_desk">Description :</label>
        <textarea id="modif_desk" name="modif_desk" placeholder="Entrez la nouvelle description" required><?php echo htmlspecialchars($tache->getDescription(), ENT_QUOTES); ?></textarea>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
