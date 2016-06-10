<?php

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';

class blogService {
	
	public function getBlogs() {
		$sqlHelper = new SQLHelper();
		$sql = "select id, title, readCount, blog_big_type, blog_small_type, small_type_order, show_order from lx_blog where is_deleted=0";
		$blogs = $sqlHelper->execute_dql_array($sql);
		return $blogs;
	}
	
	public function getRecomendId() {
		$sql = "select extension from lx_user where id=1";
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dql_array($sql);
		if(count($res) == 0) {
			return 0;
		} else {
			$jsonStr = $res[0]['extension'];
			$json = json_decode($jsonStr, true);
			if(empty($json['recomendId'])) {
				return 0;
			}
			return $json['recomendId'];
		}
	}
	
	public function setRecomentId($id) {
		$jsonStr = "{\"recomendId\":" . $id . "}";
		$sql = "update lx_user set extension='" . $jsonStr . "' where id=1";
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		if($res == 1) {
			return "success";
		} else {
			return "fail";
		}
	}
	
	public function getNewestBlog() {
		$sql = "select id, gmt_create, gmt_modify, title, img_url, tags, abstract, readCount from lx_blog where is_deleted=0 order by gmt_create desc limit 0,1";
		$sqlHelper = new SQLHelper();
		$blogArr = $sqlHelper->execute_dql_array($sql);
		if(count($blogArr) == 0) {
			return null;
		}
		return $blogArr[0];
	}
	
	public function getRecomentedBlog() {
		$id = $this->getRecomendId();
		if($id != 0) {
			$sqlHelper = new SQLHelper();
			$sql = "select id, gmt_modify, title, img_url, tags, abstract, readCount from lx_blog where is_deleted=0 and id=" . $id;
			$blogArr = $sqlHelper->execute_dql_array($sql);
			if(count($blogArr) == 0) {
				return null;
			}
			return $blogArr[0];
		} else {
			return null;
		}
	}
	
	public function getOnePageLifeBlog($page) {
		$blogsPerPage = 4;
		$sqlHelper = new SQLHelper();
		$sql = "select count(id) as count from lx_blog where blog_big_type='生活' and is_deleted=0";
		$countRes = $sqlHelper->execute_dql_array($sql);
		$totalCount = $countRes[0]['count'];
		$totalPage = floor($totalCount / $blogsPerPage);
		if($totalCount % $blogsPerPage != 0) {
			$totalPage = $totalPage + 1;
		}
		$from = ($page - 1) * $blogsPerPage;
		$sql = "select id, gmt_modify, title, img_url, tags, abstract, readCount from lx_blog where blog_big_type='生活' and is_deleted=0 order by show_order desc limit " . $from . "," . $blogsPerPage;
		$blogs = $sqlHelper->execute_dql_array($sql);
		$res = array();
		$res['curPage'] = $page;
		$res['totalPage'] = $totalPage;
		$res['blogs'] = $blogs;
		return $res;
	}
	
	public function getMaxOrder() {
		$sql = "select max(show_order) as max_show_order from lx_blog where is_deleted=0";
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dql_array($sql);
		if(count($res) == 0) {
			return 0;
		} else {
			return $res[0]['max_show_order'];
		}
	}

	public function getSmallType() {
		$sql = "select distinct blog_small_type, small_type_order from lx_blog where blog_big_type='技术' order by small_type_order";
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dql_array($sql);
		return $res;
	}
	
	public function getSkillBlog() {
		$sql = "select id, gmt_modify, title, img_url, tags, abstract, readCount, blog_small_type from lx_blog where blog_big_type='技术' and is_deleted=0 order by small_type_order, show_order desc";
		$sqlHelper = new SQLHelper();
		$blogs = $sqlHelper->execute_dql_array($sql);
		$res = array();
		$smallType = "";
		$arr = array();
		$arrIndex = 0;
		foreach($blogs as $blog) {
			if($smallType != $blog['blog_small_type']) {
				if(count($arr) != 0) {
					$res[$smallType] = $arr;
					$arrIndex = 0;
				}
				$arr = array();
				$arr[$arrIndex] = $blog;
				$arrIndex++;
			} else {
				$arr[$arrIndex] = $blog;
				$arrIndex++;
			}
			$smallType = $blog['blog_small_type'];
		}
		if(count($arr) != 0) {
			$res[$smallType] = $arr;
		}
		return $res;
	}
	
}

?>