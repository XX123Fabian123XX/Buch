<?php 
    include "Regal.php";
?>

<?php 
class Bücherei {

    private $regale;
    private $name;

    //CONSTRUCTOR
    function __construct($name, $regale = []) 
    {   
        $this->regale = $regale;
        $this->name = $name;
    }

    function regalHinzufügen($regal, $bücher = []) {

        // fügt noch Bücher dem Regal hinzu, wenn gegeben
        $regal->bücherHinzufügen($bücher);
        
        array_push($this->regale, $regal);
    }

    // Fügt einem Regal Bücher hinzu
    function bücherHinzufügen($regalName, $bücher) {
        $regal = $this->regalSuchenNachRegalnamen($regalName);
        if ($regal != null) {
            $regal->BücherHinzufügen($bücher);
        }
    }

    function buchAusleihen($buchtitel) {
        $regal = $this->regalSuchenNachBuchtitel($buchtitel);
        if ($regal != null) {
            //  gibt das Buch oder null wieder
            return $regal->buchHerausnehmen($buchtitel);
        }
        return null;
    }

    private function regalSuchenNachRegalnamen($regalName) {
        foreach($this->regale as $regal) {
            if ($regal->getName() == $regalName) {
                return $regal;
            }
        }
        return null;
    }

    private function regalSuchenNachBuchtitel($buchtitel) {
        foreach($this->regale as $regal) {       
            foreach($regal->getBücher() as $buch) {
                if ($buch->getTitel() == $buchtitel ) {
                    return $regal;
                }
            }
        } 
        return null;
    }

    // Darstellen der Bücherei
    function printBücherei() {
        $anzahlBücher = $this->bücherzählen();
        $anzahlRegale = sizeof($this->regale);

        echo "Die Bücherei '$this->name' besitzt " . $anzahlRegale . ($anzahlRegale == 1 ? " Regal" : " Regale") . " und " . $anzahlBücher  . ($anzahlBücher == 1? " Buch" :  " Bücher") . ".";
        
        echo "<br>";
        foreach($this->regale as $regal) {
            echo "-----------------------------------------------<br>";
            $regal->printBücher();
        }
        echo "<br>";
    }

    // zählt die Anzahl von Büchern
    private function bücherzählen() {
        $anzahl = 0;
        foreach($this->regale as $regal) {
            $anzahl += sizeof($regal->getBücher());
        }
        return $anzahl;
    }
}

$buch1 = new Buch("Nathan der Weise", "Lessing", 1779, 343);
$buch2 = new Buch("der Vorleser", "Bernhard Schlink", 1995, 400);
$buch3 = new Buch("BuddenBrooks. Verfall einer Familie", "Thomas Mann", 1901, 1000);
$buch4 = new Buch("Die Physiker", "Friedrich Durrenmatt", 1961, 200 );
$buch5 = new Buch("Komm, ich erzähl dir eine Geschichte", "Jorge Bucay", 2008, 352);

$dramen = new Regal("Dramen");
$romane = new Regal("Romane");

$bücherei = new Bücherei("meine Bücherei");
$bücherei->regalHinzufügen($dramen);
$bücherei->regalHinzufügen($romane,[$buch3, $buch2]);
$bücherei->bücherHinzufügen($dramen->getName(), [$buch1, $buch4]);

$bücherei->printBücherei();

// buch ausleihen (falscher Name)
$buchAusgeliehen1 = $bücherei->buchAusleihen("Nathan der Arme");

if ($buchAusgeliehen1 != null) {
    $buchAusgeliehen1->printBuch();    
} else {
    echo "Das Buch ist nicht vorhanden <br>";
}

echo "<br>";

// buch ausleihen (richtiger Name)
$buchAusgeliehen2 = $bücherei->buchAusleihen("Nathan der Weise");

if ($buchAusgeliehen2 != null) {
    $buchAusgeliehen2->printBuch();
} else {
    echo "Das Buch ist nicht vorhanden";
}

echo "<br> <br>";

$bücherei->printBücherei();

$bücherei->bücherHinzufügen($romane->getName(), [$buch5]);
$bücherei->bücherHinzufügen("Dramen", [$buch1]);
$bücherei->printBücherei();

?>