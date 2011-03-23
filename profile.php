<?php

require('./config.php');
if(!isset($_SESSION['loggedin'])) {
	header("location: ./index.php");
}



	if (isset($_POST['generate'])){
		
		
		$sWords 		= new StopWordsDictionary();
		$error = false;
		dibi::begin();
		
		
		/*
		 * Parse groups 
		 */
		$groups = json_decode(Content::getUrl("https://api.facebook.com/method/groups.get?access_token=".$_SESSION['access_token']."&format=json"), true);
		foreach ($groups as $group){

			
			$gDescription = strtolower(strip_tags($group['description']));
			//remove links
			$gDescription = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', ' ', $gDescription);
			
			/*
			 * Parse words from group name
			 */ 
			$words_tmp = preg_split('/([\s\-_,:;?!\'=\/\(\)\[\]@{}<>\r\n"]|(?<!\d)\.(?!\d))/', $group['name'], null, PREG_SPLIT_NO_EMPTY);
			
			foreach ($words_tmp as $word){
						$word = $text->prepareWord($word);
						if (is_numeric($word)) continue;
						if (strlen($word)<=2) continue;
						if ($sWords->isStopWord($word)) continue;
						$words[] = $word;
						
						//if the word is in name and description
						if (strpos($gDescription, $word)!=false){
							$dictionary->add($word."##2");
						} else {
							$dictionary->add($word."##1");
						}
			}
			/*
			 * Parse words from group description
			 */
			$words_tmp = preg_split('/([\s\-_,:;?!\'=\/\(\)\[\]@{}<>\r\n"]|(?<!\d)\.(?!\d))/', $gDescription, null, PREG_SPLIT_NO_EMPTY);
			foreach ($words_tmp as $word){
						$word = $text->prepareWord($word);
						if (is_numeric($word)) continue;
						if (strlen($word)<=2) continue;
						if ($sWords->isStopWord($word)) continue;
						$words[] = $word;
						$dictionary->add($word."##0");
			}
			
			try {
				$arr = array(
							'id_like' => $group['gid'],
							'name'  => $group['name'],
							'text'	=> $gDescription,
						);
				dibi::query('INSERT IGNORE INTO [like]', $arr);
				
				$arr = array(
							'id_user' => $_SESSION['user']['id'],
							'id_like' => $group['gid'],
						);
				dibi::query('INSERT IGNORE INTO [user_like]', $arr);
			} catch (DibiException $exception) {
				echo get_class($exception), ': ', $exception->getMessage();
				$error = true;
			}
			dibi::rollback();
			
		}
		
		/*
		 * Parse pages
		 */
		$pages = json_decode(Content::getUrl("https://api.facebook.com/method/pages.getinfo?fields=name%2Ccompany_overview%2Cdescription&access_token=".$_SESSION['access_token']."&format=json"), true);
		foreach ($pages as $page){
			//echo $page['page_id'], " : ", $page['name'], " : ", $page['description'], "<br>";
			$pDescription = strtolower(strip_tags($page['description']));
			$pDescription = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', ' ', $pDescription);
			
			/*
			 * Parse words from page name
			 */ 
			$words_tmp = preg_split('/([\s\-_,:;?!\'=\/\(\)\[\]@{}<>\r\n"]|(?<!\d)\.(?!\d))/', $page['name'], null, PREG_SPLIT_NO_EMPTY);
			foreach ($words_tmp as $word){
						$word = $text->prepareWord($word);
						if (is_numeric($word)) continue;
						if (strlen($word)<=2) continue;
						if ($sWords->isStopWord($word)) continue;
						$words[] = $word;
						
						//if the word is in name and description
						if (strpos($pDescription, $word)!=false){
							$dictionary->add($word."##2");
						} else {
							$dictionary->add($word."##1");
						}
			}
			/*
			 * Parse words from group description
			 */
			$words_tmp = preg_split('/([\s\-_,:;?!\'=\/\(\)\[\]@{}<>\r\n"]|(?<!\d)\.(?!\d))/', $pDescription, null, PREG_SPLIT_NO_EMPTY);
			foreach ($words_tmp as $word){
						$word = $text->prepareWord($word);
						if (is_numeric($word)) continue;
						if (strlen($word)<=2) continue;
						if ($sWords->isStopWord($word)) continue;
						$words[] = $word;
						$dictionary->add($word."##0");
			}
			
			try {
				$arr = array(
							'id_like' => $page['page_id'],
							'name'  => $page['name'],
							'text'	=> $pDescription,
						);
				dibi::query('INSERT IGNORE INTO [like]', $arr);
				
				$arr = array(
							'id_user' => $_SESSION['user']['id'],
							'id_like' => $page['page_id'],
						);
				dibi::query('INSERT IGNORE INTO [user_like]', $arr);
			} catch (DibiException $exception) {
				echo get_class($exception), ': ', $exception->getMessage();
				$error = true;
			}
		}
		
		
		
		$dictionary = $dictionary->get_count_values();
		foreach ($dictionary as $value=>$number){
			//echo $number, ": ", $value, "<br>";

			$values = preg_split("/##/",$value);

			//if ($number<2) break;
			$arr = array(
				'id_user' => $_SESSION['user']['id'],
				'word' => $values[0],
				'count'  => $number,
				'priority' => $values[1]
			);
			try {
				dibi::query('INSERT IGNORE INTO [user_word]', $arr, ' ON DUPLICATE KEY UPDATE priority=GREATEST(priority,'.$values[1].'),count=count+'.$number);
			} catch (DibiException $exception) {
				echo get_class($exception), ': ', $exception->getMessage();
				$error = true;
			}
		}	
		
		
		$arr = array(
				'fb_id' => $_SESSION['user']['id']
		);
		
		try {
			dibi::query('INSERT IGNORE INTO [user]', $arr);
		} catch (DibiException $exception) {
				echo get_class($exception), ': ', $exception->getMessage();
				$error = true;
		}
		
		if ($error){
			dibi::rollback();
			echo "rollback<br>";
		} else {
			dibi::commit();
		}
	}
	
	if (isset($_POST['delete'])){
		$error = false;
		dibi::begin();
		
		try {
			dibi::query('DELETE FROM [user_word] where [id_user] = %i', $_SESSION['user']['id']);
			dibi::query('DELETE FROM [user_like] where [id_user] = %i', $_SESSION['user']['id']);
			dibi::query('DELETE FROM [user] where [fb_id] = %i', $_SESSION['user']['id']);
		} catch (DibiException $exception) {
			echo get_class($exception), ': ', $exception->getMessage();
			$error = true;
		}
		
		if ($error){
			dibi::rollback();
		} else {
			dibi::commit();
		}
	}
	
	$hasCreateProfile = dibi::query('SELECT count(*) FROM [user] WHERE [fb_id] = %i', $_SESSION['user']['id'])->fetchSingle();


	
	$smarty->assign("hasCreateProfile", $hasCreateProfile, true);
	$smarty->assign("menu", "profile", true);
	$smarty->display('profile.tpl');


?>


