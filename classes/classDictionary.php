<?php

class Dictionary {

    private $slovnik;
    
    public function __construct(){
		$this->slovnik= array();
	}


    public function add($slovo){
		
		if (empty($slovo)) return;
        
        if (is_array($slovo)){
            $this->slovnik = array_merge($this->slovnik, $slovo);
            return $this;
        }

        $this->slovnik[] = $slovo;
        return $this;
    }

    public function get(){
        return $this->slovnik;
    }

    public function get_count_values($array=null){
		
		if (!empty($array)){
			$allWords = array_count_values($array);
			arsort($allWords);
			return $allWords;
		}
		
        $allWords = array_count_values($this->slovnik);
        arsort($allWords);
        return $allWords;
    }
    
    public function reset(){
    	//unset($this->slovnik);
    	$this->slovnik = array();
    }
    
}




?>
