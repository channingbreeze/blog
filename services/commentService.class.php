<?php

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';

class commentService {
	
	public function getComments($blogId) {
		$sqlHelper = new SQLHelper();
		$sql = "select id, gmt_create, username, website, content from lx_comment where blog_id = " . $blogId . " order by id desc";
		$comments = $sqlHelper->execute_dql_array($sql);
		return $comments;
	}
	
	public function addComment($blogId, $username, $email, $website, $content) {
		$sqlHelper = new SQLHelper();
		$sql = "insert into lx_comment (gmt_create, gmt_modify, blog_id, username, email, website, content) values (now(), now(), " . $blogId . ", '" . $username . "', '" . $email . "', '" . $website . "', '" . $content . "')";
		$res = $sqlHelper->execute_dqm($sql);
		if($res != 1) {
			return false;
		} else {
			return true;
		}
	}
	
	public function deleteComment($id) {
		$sqlHelper = new SQLHelper();
		$sql = "delete from lx_comment where id=" . $id;
		$res = $sqlHelper->execute_dqm($sql);
		if($res != 1) {
			return false;
		} else {
			return true;
		}
	}
	
}

?>