<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

set_time_limit(0);

include("./config.php");


if (isset($_GET['words'])){
	$word = $_GET['word'];

	$result = dibi::query('SELECT word, count FROM [user_word] WHERE %and ORDER BY priority desc, count desc', array(
		array('[word] like %~like~', $word),
		array('[id_user] = %i', $_SESSION['user']['id']),
	));


	$return = array();

	foreach ($result as $n => $row) {
		$return[] = array($row['word'], $row['count']);
		//echo $i, ": <b>", $row['word'], "</b><br>";
	}

	echo json_encode($return);
}

if (isset($_GET['likes'])){
	$word = $_GET['word'];
	
	$sWords 		= new StopWordsDictionary();

	$result = dibi::query('SELECT name, text FROM [like] where [name] like %~like~', $word);


	$return = array();
	
	$LikeText = "";
	
	foreach ($result as $n => $row) {
		$return["name"][] = array($row['name']);
		$LikeText.= " ".$row['text']." ".$row['name'];
	}
	/*
	$words_tmp = preg_split('/([\s\-_,:;?!\'=\/\(\)\[\]@{}<>\r\n"]|(?<!\d)\.(?!\d))/', $LikeText, null, PREG_SPLIT_NO_EMPTY);
	foreach ($words_tmp as $word){
				$word = $text->prepareWord($word);
				if (is_numeric($word)) continue;
				if (strlen($word)<=2) continue;
				if ($sWords->isStopWord($word)) continue;
				$words[] = $word;
				$dictionary->add($word);
	}
	$dictionary = $dictionary->get_count_values();
	
	foreach ($dictionary as $word=>$count){
		if (dibi::query('SELECT count(*) FROM [user_word] WHERE %and', array(
						array('[word] like %~like~', $word),
						'(priority=1 or count>1)',
			))->fetchSingle() != 1) {
			continue;
		}
		$return["words"][] = array($word, $count);
	}
	*/
	//$return["words"][] = $dictionary;
	
	print_r(json_encode($return));
}

?>


