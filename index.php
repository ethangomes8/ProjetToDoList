<?php
require_once "connect.php";

$error = $_GET['error'] ?? '';
$message = $_GET['message'] ?? '';
$taches = $tacheManager->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Tâches</title>
    <link rel="stylesheet" href="style.css"> 
    <script>
        function confirmersuppression() {
            return confirm("Voulez-vous vraiment supprimer cette tâche ?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Liste de Tâches</h1>

        <form action="ajouter.php" method="POST" class="task-form" id="taskForm">
            <div class="input-group">
                <label for="taskInput" class="visually-hidden">Nom de la Tâche</label>
                <input type="text" name="titre" id="nomtache" class="input-field" placeholder="Entrer le nom de la tâche">
            </div>

            <div class="input-group">
                <label for="descriptionInput" class="visually-hidden">Description</label>
                <input type="text" name="description" id="descriptiontache" class="input-field" placeholder="Entrer la description">
            </div>

            <div class="button-group">
                <button type="submit" name="valider" class="add-button">Enregistrer</button>
            </div>
        </form>

        <?php if ($error): ?>
            <div style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div>
        <?php endif; ?>

        <?php if ($message): ?>
            <div style="color: green;"><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
        <?php endif; ?>

        <div class="task-list">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fait</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($taches) > 0): ?>
                        <?php foreach ($taches as $tache): ?>
                            <tr>
                                <td><input type="checkbox" class="task-checkbox"></td>
                                <td><?php echo htmlspecialchars($tache->getTitre(), ENT_QUOTES); ?></td>
                                <td><?php echo htmlspecialchars($tache->getDescription(), ENT_QUOTES); ?></td>
                                <td>
                                    <form action="modifier.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($tache->getId(), ENT_QUOTES); ?>">
                                        <button type="submit" class="modif-button">Modifier</button>
                                    </form>
                                    <form action="supprimer.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($tache->getId(), ENT_QUOTES); ?>">
                                        <button type="submit" class="suppr-button" onclick="return confirmersuppression()">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Aucune tâche trouvée</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>