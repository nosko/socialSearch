<?php


class Facebook {

	
	public static function getGroups($token){
		return Content::getUrl("https://graph.facebook.com/me/groups?access_token=".$token);		
	}
	
	public static function getLikes($token){
		return Content::getUrl("https://graph.facebook.com/me/likes?access_token=".$token);
	}
	
	public function createProfile(){
		$groups = $this->getGroups();
		
		foreach ($groups['data'] as $group){
			$words = preg_split('/([\s\-_,:;?!\'=\/\(\)\[\]{}<>\r\n"]|(?<!\d)\.(?!\d))/', $group['name'], null, PREG_SPLIT_NO_EMPTY);
		}	
	}
	
	
}


?>
