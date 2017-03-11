<?php

if(isset($_GET['username'])) {
	$findUser = '';
	$users = file_get_contents('users/register.txt');
	$users = explode(PHP_EOL,$users);
	array_pop($users);
	for ($index=0;count($users)>$index;$index++) {
		$arrayWhithUsers[] = explode('#',$users[$index]);
		
	}

	foreach ($arrayWhithUsers as $user){
		if($user[0] == $_GET['username']) {
			$findUser = "That username is taken. Try another.";
			break;
	}
	}
	echo $findUser;
}
?>