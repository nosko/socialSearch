<?php

require('./config.php');


if(!isset($_SESSION['loggedin'])) {
	header("location: ./index.php");
}


	$smarty->assign("submit", isset($_POST['submit']), true);

	if (isset($_POST['submit'])){
		
		$sWords = new StopWordsDictionary();
		
		
		//$result = dibi::query('SELECT * FROM [user_word] where [id_user]=%i AND priorityORDER BY priority desc, count desc', $_SESSION['user']['id']);
		$result = dibi::query('SELECT * FROM [user_word] WHERE %and ORDER BY priority desc, count desc', array(
			array('[priority] >=%i', 0),
			array('[id_user] = %i', $_SESSION['user']['id']),
		));
		
		$results = array();
		$yourWords = "";
		foreach ($result as $n => $row) {
			$results[$row['word']]= $row['count'];
			$yourWords.= $row['count'].": ".$row['word']."<br>";
		}
		$smarty->assign("yourWords", $yourWords, true);
		
		
		
		$timeReference = microtime(true);
		$reference = Context::getReference($_POST['text']);
		foreach ($reference as $item) {
			$words = $sWords->removeStopWords($item, 3);
			$dictionaryWeb->add($words);
		}
		$timeReference2 = microtime(true);
		
		$timeWordnik = microtime(true);
		$wordnik = Context::getWordnik($_POST['text'], array("century","wiktionary","webster","wordnet"));
		foreach ($wordnik as $item) {
			$words = $sWords->removeStopWords($item, 3);
			$dictionaryWeb->add($words);
		}
		$timeWordnik2 = microtime(true);
		
		$timeGoogle = microtime(true);
		$google = Context::getGoogle($_POST['text']);
		foreach ($google as $item) {
			$words = $sWords->removeStopWords($item, 3);
			$dictionaryWeb->add($words);
		}
		$timeGoogle2 = microtime(true);
		
		$timeWikipedia = microtime(true);
		$wikipedia = Context::getWikipedia($_POST['text']);
		foreach ($wikipedia as $item) {
			$words = $sWords->removeStopWords($item, 3);
			$dictionaryWeb->add($words);
		}
		$timeWikipedia2 = microtime(true);
		
		
		$webWords = "";
		$values = $dictionaryWeb->get_count_values();
		foreach ($values as $value=>$number){
			$webWords.=$number.": ".$value."<br>";
		}
		$smarty->assign("webWords", $webWords, true);
			
		
		

		$timeFBSearch = microtime(true);
		$fbcontent = Context::getFbResult($_POST['text']);
		$fbWords = "";
		foreach ($fbcontent as $item) {
				$words = $sWords->removeStopWords($item, 3);
				$fbDictionary->add($words);
		}
		$timeFBSearch2 = microtime(true);
		
		$values = $fbDictionary->get_count_values();
		foreach ($values as $item=>$count){
			$fbWords.=$count.": ".$item."<br>";
		}
		$smarty->assign("fbWords", $fbWords, true);

		
		
		$intersection = "";
		$web = $dictionaryWeb->get_count_values();
		$fb = $fbDictionary->get_count_values();
		unset($web[$_POST['text']]);
		unset($fb[$_POST['text']]);
		
		
		$sortedResults = array();
		
		
		function compare($x, $y)
		{
		 if ( $x[0] == $y[0] ){
			if ( $x[2] == $y[2] ){
				return 0;
			} else {
				if ( $x[2] > $y[2] )
					return -1;
				else
					return 1;
			}
		}
		 else if ( $x[0] > $y[0] )
		  return -1;
		 else
		  return 1;
		}
		
		$inter = array_intersect_key($results, $web, $fb);
		foreach ($inter as $item=>$count){
			$intersection.= "[".$results[$item]." : ".$web[$item]." : ".$fb[$item]."] ".$item."<br>";
			$wordOccurance = dibi::query('SELECT count(*)+(SELECT count*priority from [user_word] where [word]=%s',$item,' AND [id_user]=%i',$_SESSION['user']['id'],') FROM [like] WHERE [id_like] IN 
											(SELECT [id_like] from [user_like] where [id_user] =%i', $_SESSION['user']['id'],') 
											AND [name] like %~like~', $item
							)->fetchSingle();	
			echo $item, " - ", $wordOccurance, "<br>";				
			$sortedResults[] = array($results[$item]+$wordOccurance, $web[$item], $fb[$item], $item);
			
			
		}
		if (empty($inter)){
			$intersection = "ziadne hodnoty<br>";
		}
		
		uasort($sortedResults, "compare");

		
		$smarty->assign("intersection", $intersection, true);
		$smarty->assign("sortedIntersection", $sortedResults, true);
		
		
		$smarty->assign("reference", $timeReference2-$timeReference, true);
		$smarty->assign("wikipedia", $timeWikipedia2-$timeWikipedia, true);
		$smarty->assign("google", $timeGoogle2-$timeGoogle, true);
		$smarty->assign("wordnik", $timeWordnik2-$timeWordnik, true);
		$smarty->assign("facebook", $timeFBSearch2-$timeFBSearch, true);
		
	}

$smarty->assign("menu", "search", true);
$smarty->display('search.tpl');

?>
