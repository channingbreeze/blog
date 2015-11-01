<?php 

session_start();
if(!isset($_SESSION['username'])) {
	echo "fail";
}

require_once dirname ( __FILE__ ) . '/../../tools/SQLHelper.class.php';

if(isset($_POST['keywords']) &&
	isset($_POST['description']) &&
	isset($_POST['picurl']) &&
	isset($_POST['title']) &&
	isset($_POST['abstract']) &&
	isset($_POST['tags']) &&
	isset($_POST['blog']) &&
	isset($_POST['bigtype']) &&
	isset($_POST['smalltype']) &&
	isset($_POST['smalltypeorder']) &&
	isset($_POST['showorder'])) {
	
	$keywords = $_POST['keywords'];
	$description = $_POST['description'];
	$picurl = $_POST['picurl'];
	$title = $_POST['title'];
	$abstract = $_POST['abstract'];
	$tags = $_POST['tags'];
	$blog = $_POST['blog'];
	$bigtype = $_POST['bigtype'];
	$smalltype = $_POST['smalltype'];
	$smalltypeorder = $_POST['smalltypeorder'];
	$showorder = $_POST['showorder'];
	
	if(isset($_POST['id'])) {
		$update = true;
		$id = $_POST['id'];
	} else {
		$update = false;
	}
	
	$sqlHelper = new SQLHelper();
	
	$tagArr = explode(' ', $tags);
	foreach($tagArr as $tag) {
		$sql = "select * from lx_tag where tagname='" . $tag . "'";
		$res = $sqlHelper->execute_dql_array($sql);
		if(count($res) == 0) {
			$sql = "insert into lx_tag (gmt_create, gmt_modify, tagname, count) values (now(), now(), '" . $tag . "', 1)";
			$sqlHelper->execute_dqm($sql);
		} else {
			if(!$update) {
				$count = $res[0]['count'] + 1;
				$sql = "update lx_tag set count=" . $count . " where id=" . $res[0]['id'];
				$sqlHelper->execute_dqm($sql);
			}
		}
	}
	
	if(!$update) {
		$sql = "insert into lx_blog (gmt_create, gmt_modify, title, img_url, keywords, description, tags, abstract, content, readCount, blog_big_type, blog_small_type, small_type_order, is_deleted, show_order) values (now(), now(), '" . $title . "', '" . $picurl . "', '" . $keywords . "', '" . $description . "', '" . $tags . "', '" . $abstract . "', '" . $blog . "', 0, '" . $bigtype . "', '" . $smalltype . "', " . $smalltypeorder . ", 0, " . $showorder . ")";
	} else {
		$sql = "update lx_blog set gmt_modify=now(), title='" . $title . "', img_url='" . $picurl . "', keywords='" . $keywords . "', description='" . $description . "', tags='" . $tags . "', abstract='" . $abstract . "', content='" . $blog . "', blog_big_type='" . $bigtype . "', blog_small_type='" . $smalltype . "', small_type_order=" . $smalltypeorder . ", show_order=" . $showorder . " where id=" . $id;
	}
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
