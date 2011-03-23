<?php


class Context {
	
	public function getWikipedia($word){
		$content = Content::getUrl("http://en.wikipedia.org/w/api.php?action=opensearch&format=xml&limit=16&search=".$word);
		$xml = simplexml_load_string($content);
		
		$result = array();

		foreach ($xml->Section->Item as $item) {
			$text = TextPreparation::prepareWord($item->text);
			$result[] = TextPreparation::sentence2Words($text);
			
			$description = TextPreparation::prepareWord($item->Description);
			$result[] = TextPreparation::sentence2Words($description);
		}
		
		return $result;
	}
	
	
	public function getWordnik($word, $dictionaries) {
		$result = array();

		if (!is_array($dictionaries)){
			$dictionaries = array($dictionaries);
		}
			
		foreach ($dictionaries as $dictionary){		
			$content = Content::getUrl("http://api.wordnik.com/api/word.xml/".$word."/definitions?api_key=".Settings::$WORDNIK_KEY."&sourceDictionary=".$dictionary);
			$xml = simplexml_load_string($content);		

			foreach ($xml->definition as $item) {
				$text = TextPreparation::prepareWord($item->text);
				$result[] = TextPreparation::sentence2Words($text);
				
				$extendedText = TextPreparation::prepareWord($item->extendedText);
				$result[] = TextPreparation::sentence2Words($extendedText);
			}
		}
		return $result; 
    }
	
	public function getGoogle($word){
		$nalezy = array();
		$result = array();
		
		preg_match_all('/(<li>)(\w.*)(<)/ismU', Content::getUrl("http://www.google.com/search?hl=en&q=define:".$word."&btnG=Search"), $nalezy, PREG_SET_ORDER);
		foreach ($nalezy as $item){
			$item = TextPreparation::prepareWord($item[2]);
			$result[] = TextPreparation::sentence2Words($item);
		}
		return $result;
	}
	
	
	public function getUrbanDictionary($word){
		$nalezy = array();
		$result = array();
		
		preg_match_all("/<div class='definition'>(.*?)<\/div>/ismU", Content::getUrl("http://www.urbandictionary.com/define.php?term=".$word), $nalezy, PREG_SET_ORDER);
		
		print_r($nalezy);
		foreach ($nalezy as $item){
			$item = TextPreparation::prepareWord($item[1]);
			$result[] = TextPreparation::sentence2Words($item);
		}
		return $result;
	}
	
	public function getReference($word){
		$nalezy = array();
		$result = array();
		
		preg_match_all('/(<td class="td3n2">)(.*)(<\/td>)/ismU', Content::getUrl("http://dictionary.reference.com/browse/".$word), $nalezy, PREG_SET_ORDER);
		foreach ($nalezy as $item) {
			$item = TextPreparation::prepareWord($item[0]);
			$result[] = TextPreparation::sentence2Words(strip_tags($item));
		}
		return $result;
	}
	
	public function getFbResult($word){
		$result = array();
		$content = json_decode(Content::getUrl("https://graph.facebook.com/search?q=".$word."&type=page&limit=200"), true);
		
		foreach ($content['data'] as $item) {
			$item = TextPreparation::prepareWord($item['name']);
			$result[] = TextPreparation::sentence2Words($item);
		}
		return $result;
	}
	
	
	
	
	
}





?>
