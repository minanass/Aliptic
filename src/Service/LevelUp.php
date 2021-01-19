<?php
namespace App\Service;

class LevelUp {

	public static function checkLevel($user) {
		$level = $user->getLevel();
		
	    if ($level == 1) {
	    	$user->setLevel(2);
	    }
	    elseif ($level == 2) {
	    	$user->setLevel(3);
	    } 
	}
}

