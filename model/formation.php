<?php
class formation {
    private ?int $idForm;
    private ?string $nom;
    private ?string $type;
    private ?string $image;
    private ?string $description;

    public function __construct($id = null, $n, $t, $i, $d) {
        $this->idForm = $id;
        $this->nom = $n;
        $this->type = $t;
        $this->image = $i;
        $this->description = $d;
    }

    public function getIdForm() {
        return $this->idForm;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setIdForm($id) {
        $this->idForm = $id;
        return $this;
    }
}
?>
