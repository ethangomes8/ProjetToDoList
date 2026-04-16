<?php

class TacheManager {
    private $pdo;

    public function __construct(Database $database) {
        $this->pdo = $database->getConnection();
    }

    public function getAll() {
        $sql = 'SELECT id, titre, description FROM taches';
        $stmt = $this->pdo->query($sql);
        $taches = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $taches[] = new Tache($row['id'], $row['titre'], $row['description']);
        }

        return $taches;
    }

    public function getById($id) {
        $sql = 'SELECT id, titre, description FROM taches WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Tache($row['id'], $row['titre'], $row['description']);
        }

        return null;
    }

    public function add(Tache $tache) {
        $sql = 'INSERT INTO taches (titre, description) VALUES (:titre, :description)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'titre' => $tache->getTitre(),
            'description' => $tache->getDescription(),
        ]);
    }

    public function update(Tache $tache) {
        $sql = 'UPDATE taches SET titre = :titre, description = :description WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'titre' => $tache->getTitre(),
            'description' => $tache->getDescription(),
            'id' => $tache->getId(),
        ]);
    }

    public function delete($id) {
        $sql = 'DELETE FROM taches WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
