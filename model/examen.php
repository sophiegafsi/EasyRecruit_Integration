<?php
class Examen {
    private ?int $id;
    private ?string $nom;
    private ?string $date;
    private ?int $formation_id;

    public function __construct($id = null, $nom, $date, $formation_id) {
        $this->id = $id;
        $this->nom = $nom;
        $this->date = $date;
        $this->formation_id = $formation_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    public function getFormationId() {
        return $this->formation_id;
    }

    public function setFormationId($formation_id) {
        $this->formation_id = $formation_id;
        return $this;
    }
}
?>
