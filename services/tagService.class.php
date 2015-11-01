<?php

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';

class tagService {
	
	public function getTags() {
		$sqlHelper = new SQLHelper();
		$sql = "select tagname from lx_tag order by count desc";
		$tags = $sqlHelper->execute_dql_array($sql);
		return $tags;
	}
	
}

?>