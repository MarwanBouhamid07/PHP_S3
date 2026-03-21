<?php
class Hamid {
    private $titre;
    private $contenu;

    public function setTitre($titre) {
        if (!empty($titre) && strlen($titre) > 3) {
            $this->titre = $titre;
        } else {
            echo "Titre invalide.";
        }
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setContenu($contenu) {
        $this->contenu = htmlspecialchars($contenu);
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function afficher() {
        return "Titre : {$this->titre} - Contenu : {$this->contenu}";
    }
}
