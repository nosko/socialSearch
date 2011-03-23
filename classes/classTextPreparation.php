<?php

class TextPreparation {
    
    
    public static function sentence2Words($sentence){
		return preg_split('/([\s\-_,*:;?!\'=\/\(\)\[\]{}<>\r\n"]|(?<!\d)\.(?!\d))/', $sentence, null, PREG_SPLIT_NO_EMPTY);
	}
	
	public static function prepareWord($word){
		//source: http://cs.wikibooks.org/wiki/PHP_prakticky/Odstran%C4%9Bn%C3%AD_diakritiky
		$prevodni_tabulka = Array(
		  'ä'=>'a',
		  'Ä'=>'A',
		  'á'=>'a',
		  'Á'=>'A',
		  'à'=>'a',
		  'À'=>'A',
		  'ã'=>'a',
		  'Ã'=>'A',
		  'â'=>'a',
		  'Â'=>'A',
		  'č'=>'c',
		  'Č'=>'C',
		  'ć'=>'c',
		  'Ć'=>'C',
		  'ď'=>'d',
		  'Ď'=>'D',
		  'ě'=>'e',
		  'Ě'=>'E',
		  'é'=>'e',
		  'É'=>'E',
		  'ë'=>'e',
		  'Ë'=>'E',
		  'è'=>'e',
		  'È'=>'E',
		  'ê'=>'e',
		  'Ê'=>'E',
		  'í'=>'i',
		  'Í'=>'I',
		  'ï'=>'i',
		  'Ï'=>'I',
		  'ì'=>'i',
		  'Ì'=>'I',
		  'î'=>'i',
		  'Î'=>'I',
		  'ľ'=>'l',
		  'Ľ'=>'L',
		  'ĺ'=>'l',
		  'Ĺ'=>'L',
		  'ń'=>'n',
		  'Ń'=>'N',
		  'ň'=>'n',
		  'Ň'=>'N',
		  'ñ'=>'n',
		  'Ñ'=>'N',
		  'ó'=>'o',
		  'Ó'=>'O',
		  'ö'=>'o',
		  'Ö'=>'O',
		  'ô'=>'o',
		  'Ô'=>'O',
		  'ò'=>'o',
		  'Ò'=>'O',
		  'õ'=>'o',
		  'Õ'=>'O',
		  'ő'=>'o',
		  'Ő'=>'O',
		  'ř'=>'r',
		  'Ř'=>'R',
		  'ŕ'=>'r',
		  'Ŕ'=>'R',
		  'š'=>'s',
		  'Š'=>'S',
		  'ś'=>'s',
		  'Ś'=>'S',
		  'ť'=>'t',
		  'Ť'=>'T',
		  'ú'=>'u',
		  'Ú'=>'U',
		  'ů'=>'u',
		  'Ů'=>'U',
		  'ü'=>'u',
		  'Ü'=>'U',
		  'ù'=>'u',
		  'Ù'=>'U',
		  'ũ'=>'u',
		  'Ũ'=>'U',
		  'û'=>'u',
		  'Û'=>'U',
		  'ý'=>'y',
		  'Ý'=>'Y',
		  'ž'=>'z',
		  'Ž'=>'Z',
		  'ź'=>'z',
		  'Ź'=>'Z'
		);

		
		$word = strtr($word, $prevodni_tabulka);
		
		return trim(strToLower($word));
	}

	
}



?>
