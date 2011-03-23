<?php


class stopWordsDictionary {
	
	private $stopWordsList = array();


    public function __construct() {
        foreach ( explode("\n", file_get_contents("stopWordsEN.txt")) as $word ){
            $this->stopWordsList[] = trim($word);
        }

        foreach ( explode("\n", file_get_contents("stopWordsSK.txt")) as $word ){
            $this->stopWordsList[] = trim($word);
        }
        
        foreach ( explode("\n", file_get_contents("stopWordsDE.txt")) as $word ){
            $this->stopWordsList[] = trim($word);
        }
    }
    
    public function isStopWord($word){
    	return in_array($word, $this->stopWordsList);
    }


    public function removeStopWords($sentence, $removeWordsShorterThan=-1){
		// if a string was given
		if (!is_array($sentence)){
			if (in_array($sentence, $this->stopWordsList)){
				return "";
			}
			else {
				return ($sentence<$removeWordsShorterThan) ? "" : $sentence;
			}
		}

		$result = array();

		
        foreach ($sentence as $word) {
			//remove words with length less than $removeWordsShorterThan
			if (strlen($word) < $removeWordsShorterThan){
				continue;
			}
			
            if (!in_array($word, $this->stopWordsList)){
				$result[] = $word;
            }
        }

        return $result;
    }

    public function getStopWordsList(){
        return $this->stopWordsList;
    }
    
}






?>
