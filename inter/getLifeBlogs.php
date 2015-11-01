<?php 

require_once dirname ( __FILE__ ) . '/../services/blogService.class.php';

if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
	
$blogService = new BlogService();
$res = $blogService->getOnePageLifeBlog($page);
echo json_encode($res);

?>
