<?php

class Tache {
    private $id;
    private $titre;
    private $description;

    public function __construct($id = null, $titre = '', $description = '') {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}
