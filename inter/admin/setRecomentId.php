<?php 

session_start();
if(!isset($_SESSION['username'])) {
	echo "fail";
}

require_once dirname ( __FILE__ ) . '/../../services/blogService.class.php';

if(isset($_POST['id'])) {
	
	$id = $_POST['id'];
	
	$blogService = new BlogService();
	echo $blogService->setRecomentId($id);
		
} else {
	echo "fail";
}

?>
