<?php 

session_start();
if(!isset($_SESSION['username'])) {
	echo "fail";
}

require_once dirname ( __FILE__ ) . '/../../tools/SQLHelper.class.php';

if(isset($_POST['type']) &&
	isset($_POST['order'])) {
	
	$type = $_POST['type'];
	$order = $_POST['order'];
	
	$sqlHelper = new SQLHelper();
	$sql = "update lx_blog set small_type_order=" . $order . " where blog_small_type='" . $type . "'";
	$res = $sqlHelper->execute_dqm($sql);
	if($res == 0) {
		echo "fail";
	} else {
		echo "success";
	}
	
} else {
	echo "fail";
}

?>
