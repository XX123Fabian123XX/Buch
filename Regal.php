<?php 
include "Buch.php";
?>
<?php 
class Regal {

    private $bücher;
    private $name;

    //CONSTRUCTOR
    public function __construct($name, $bücher = [])
    {
        $this->name = $name;
        $this->bücher = $bücher;
    }

    
    public function bücherHinzufügen($bücher) {
        foreach($bücher as $buch) {
            array_push($this->bücher, $buch);
        }
    }

    // löscht das Buch und gibt dieses zurück
    public function buchHerausnehmen($buchtitel) {
        $index = $this->buchFindenIndex($buchtitel);
        if ($index > -1) {
            $buch = $this->bücher[$index];

            // löscht das Buch aus dem Array
            \array_splice($this->bücher, $index, 1);
            
            return $buch;
        }
        return null;
    }

    // sucht anhand des Titels nach dem Buch und gibt den Index zurück
    private function buchFindenIndex($buchtitel) {
        $index = 0;
        foreach($this->bücher as $buch) {
            
            if ($buch->getTitel() == $buchtitel) {
                return $index;
            }
            $index++;
        }
        return null;
    }

    // Darstellung des Regals
    public function printBücher() {
        if (sizeof($this->bücher) == 0) {
            echo "Das Regal '$this->name' hat keine Bücher. <br>";
            return;
        }

        echo "Das Regal '$this->name' hat " . sizeof($this->bücher) . (sizeof($this->bücher) == 1 ? ' Buch' : ' Bücher') . ": <br> <br>" ;
        $index = 1;
        foreach($this->bücher as $buch) {
            echo "$index. ";
             $buch->printBuch();
             echo "<br>";
             $index+=1;
        }
    }

    /////////////////////
    // GETTER
    public function getBücher() {
        return $this->bücher;
    }

    public function getName() {
        return $this->name;
    }
}    
?>


