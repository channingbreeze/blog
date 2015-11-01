<?php 

session_start();
if(!isset($_SESSION['username'])) {
	echo "fail";
}

require_once dirname ( __FILE__ ) . '/../../tools/SQLHelper.class.php';

if(isset($_POST['id'])) {
	
	$id = $_POST['id'];
	
	$sqlHelper = new SQLHelper();
	$sql = 'update lx_blog set is_deleted=1 where id=' . $id;
	$res = $sqlHelper->execute_dqm($sql);
	if($res != 1) {
		echo "fail";
	} else {
		echo "success";
	}
	
} else {
	echo "fail";
}

?>
