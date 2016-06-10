<?php 

require_once dirname ( __FILE__ ) . '/../services/commentService.class.php';
require_once dirname ( __FILE__ ) . '/../tools/StringUtil.class.php';

if(isset($_POST['id']) &&
	isset($_POST['username']) &&
	isset($_POST['email']) &&
	isset($_POST['website']) &&
	isset($_POST['content'])) {
	
	$id = $_POST['id'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$content = $_POST['content'];
	
	// 如果用户名或者评论为空，返回false
	if(empty(trim($username)) || empty(trim($content))) {
		echo false;
	} else {
	
		if(!StringUtil::startsWith($website, "http")) {
			$website = "http://" . $website;
		}
		
		$commentService = new CommentService();
		$res = $commentService->addComment($id, $username, $email, $website, $content);
		if($res) {
			echo "true";
		} else {
			echo "false";
		}
	}
	
} else {
	echo "false";
}

?>
