<?php

class Buch {

    private $titel;
    private $author;
    private $erscheinungsjahr;
    private $seitenanzahl;

    public function __construct($titel, $author, $erscheinungsjahr, $seitenanzahl) {
        $this->titel = $titel;
        $this->author = $author;
        $this->erscheinungsjahr = $erscheinungsjahr;
        $this->seitenanzahl = $seitenanzahl;
    }

    public function printBuch() {
        echo "Das Buch '$this->titel' wurde von $this->author verfasst. 
        Es entstand im Jahre $this->erscheinungsjahr und ist $this->seitenanzahl Seiten lang.";
    }

    /////////////////////
    // GETTER
    public function getTitel() {
        return $this->titel;
    }
}
?>