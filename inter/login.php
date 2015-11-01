<?php

require_once dirname ( __FILE__ ) . '/../tools/ConfigUtil.class.php';

	session_start();
	if(isset($_SESSION['user'])) {
		header("Location: ../admin/index.php");
	} else {
		if( isset($_POST['username']) &&
			isset($_POST['password']) ) {
			
			if(ConfigUtil::getInstance()->username == $_POST['username'] &&
				ConfigUtil::getInstance()->password == $_POST['password']) {
				
				$_SESSION['user'] = $_POST['username'];
				header("Location: ../admin/index.php");
				
			} else {
				header("Location: ../admin/login.php");
			}
			
		} else {
			header("Location: ../admin/login.php");
		}
	}

?>