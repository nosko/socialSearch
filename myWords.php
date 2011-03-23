<?php

require('./config.php');

if(!isset($_SESSION['loggedin'])) {
	header("location: ./index.php");
}


$result = dibi::query('SELECT * FROM [user_word] where [id_user]=%i ORDER BY priority desc, count desc', $_SESSION['user']['id']);

$i = 1;
$results = "";
foreach ($result as $n => $row) {
    $results.=$i.": <b>".$row['word']."</b> [ pocet: ".$row['count']." priorita: ".$row['priority']." ]<br>";
    $i++;
}

$smarty->assign("result", $results,true);
$smarty->assign("menu", "myWords", true);
$smarty->display('myWords.tpl');

?>
