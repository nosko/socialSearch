<?php

require('./config.php');


if(!isset($_SESSION['loggedin'])) {
	header("location: ./index.php");
}


	$smarty->assign("submit", isset($_POST['submit']), true);
	//has user generated profile yet?
	$profileExists = dibi::query('SELECT count(*) FROM [user] where [fb_id]=%i', $_SESSION['user']['id'])->fetchSingle();
	
	//there isn't user profile, let's search just the web and facebook
	if ( $profileExists == "0" )
	{
		$smarty->assign("noProfile", true, true);
	}

	if (isset($_POST['submit'])){
		
		$sWords = new StopWordsDictionary();
		
		//if there is user profile
		if ( $profileExists == "1" )
		{		
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
		}
		
		
		
		
		
		
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
		
		
		function compare3($x, $y)
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
		
		function compare2($x, $y)
		{
		 if ( $x[1] == $y[1] ){
			if ( $x[0] == $y[0] ){
				return 0;
			} else {
				if ( $x[0] > $y[0] )
					return -1;
				else
					return 1;
			}
		}
		 else if ( $x[1] > $y[1] )
		  return -1;
		 else
		  return 1;
		}
		
		if ( $profileExists )
		{
			$inter = array_intersect_key($results, $web, $fb);
		}
		else 
		{	
			$inter = array_intersect_key($web, $fb);
		}
		
		
		if (empty($inter))
		{
			$intersection = "No values<br>";
		} else 
		{
			if ( $profileExists )
			{
				foreach ($inter as $item=>$count){
					$intersection.= "[".$results[$item]." : ".$web[$item]." : ".$fb[$item]."] ".$item."<br>";
					$wordOccurance = dibi::query('SELECT count(*)+(SELECT count*priority from [user_word] where [word]=%s',$item,' AND [id_user]=%i',$_SESSION['user']['id'],') FROM [like] WHERE [id_like] IN 
													(SELECT [id_like] from [user_like] where [id_user] =%i', $_SESSION['user']['id'],') 
													AND [name] like %~like~', $item
									)->fetchSingle();				
					$sortedResults[] = array($results[$item]+$wordOccurance, $web[$item], $fb[$item], $item);	
				}
				uasort($sortedResults, "compare3");
			}
			else 
			{
				foreach ($inter as $item=>$count){
					$sortedResults[] = array($web[$item], $fb[$item], $item);
				}
				uasort($sortedResults, "compare2");
			}
		}
		
		$smarty->assign("sortedResults", $sortedResults, true);
		
		
		
		$smarty->assign("reference", $timeReference2-$timeReference, true);
		$smarty->assign("wikipedia", $timeWikipedia2-$timeWikipedia, true);
		$smarty->assign("google", $timeGoogle2-$timeGoogle, true);
		$smarty->assign("wordnik", $timeWordnik2-$timeWordnik, true);
		$smarty->assign("facebook", $timeFBSearch2-$timeFBSearch, true);
		
	}

$smarty->assign("menu", "search", true);
$smarty->display('search.tpl');

?>
