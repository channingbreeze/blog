<?php 

require_once dirname ( __FILE__ ) . '/tools/SQLHelper.class.php';

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sqlHelper = new SQLHelper();
	$sql = "select * from lx_blog where is_deleted=0 and id=" . $id;
	$res = $sqlHelper->execute_dql_array($sql);
	if(count($res) == 0) {
		exit();
	} else {
		$blog = $res[0];
		$sql = "update lx_blog set readCount=readCount+1 where id=" . $blog['id'];
		$sqlHelper->execute_dqm($sql);
		$sql = "select id, gmt_create, username, website, content from lx_comment where blog_id = " . $blog['id'] . " order by id desc";
		$comments = $sqlHelper->execute_dql_array($sql);
	}
} else {
	exit();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <meta name="Keywords" content="<?php echo $blog['keywords'];?>" />
		<meta name="Description" content="<?php echo $blog['description'];?>" />
        <link href="css/global.css" rel="stylesheet"></link>
        <link href="css/common.css" rel="stylesheet"></link>
        <link href="css/blog.css" rel="stylesheet"></link>
        <script src="js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<?php include_once 'partials/header.php'; ?>
    	<div class="middlediv">
    		<div class="titleDiv">
	    		<div class="title"><?php echo $blog['title'];?></div>
	    		<div class="readCount">阅读<?php echo $blog['readCount'] + 1;?>次</div>
	    		<div class="blogDate"><?php echo $blog['gmt_create'];?></div>
    		</div>
    		<div class="absInfo">
    			<img src="<?php echo $blog['img_url'];?>" />
    			<ul class="tags">
    				<?php 
    					foreach(explode(' ', $blog['tags']) as $tag) {
							?>
							<li><?php echo $tag;?></li>
							<?php
						}
    				?>
    			</ul>
    			<div class="abstract"><?php echo $blog['abstract'];?></div>
    		</div>
    		<div class="clear"></div>
    		<div class="content">
    			<?php echo $blog['content'];?>
    		</div>
    		<div class="">转载请注明出处：<a href="www.baidu.com">http://dddd.cccc.xxxx</a></div>
    		<hr />
    		<div class="authorInfo">
    			<div class="authorTitle">作者简介：</div>
    			<img src="images/head.png" />
    			<div class="authorName">李欣</div>
    			<div class="authorBrief">阿里巴巴员工，慕课网认证讲师，全栈工程师</div>
    			<div class="moreInfo">
    				<div class="title">想了解更多，扫描二维码加我微信</div>
    				<img src="images/wxme.jpg" />
    			</div>
    		</div>
    		<div class="clear"></div>
    		<hr />
    		<div class="commentDiv">
    			<div class="commentTitle">评论：</div>
	    		<ul class="commentUl">
	    			<?php 
	    			foreach($comments as $comment) {
					?>
					<li>
	    				<div class="username"><?php if(empty($comment['website'])) {echo $comment['username'];} else {echo "<a href='" . $comment['website'] . "' target='_blank'>" . $comment['username'] . "</a>";}?>：</div>
	    				<div class="date"><?php echo $comment['gmt_create'];?></div>
	    				<div class="comment"><?php echo $comment['content'];?></div>
	    			</li>
					<?php 
					}
	    			?>
	    		</ul>
	    		<form class="commentForm" id="commentForm">
	    			<input type="hidden" name="id" value="<?php echo $blog['id'];?>" />
	    			<div class="line">用户名：<input type="text" name="username"/></div>
	    			<div class="line">邮　箱：<input type="text" name="email" placeholder="选填"/></div>
	    			<div class="line">主　页：<input type="text" name="website" placeholder="选填"/></div>
	    			<div class="line"><textarea rows="" cols="" name="content"></textarea></div>
	    			<div class="line center"><button id="submit">提交</button></div>
	    		</form>
    		</div>
    	</div>
    	<?php include_once 'partials/footer.php'; ?>
        <script src="js/blog.js"></script>
    </body>
</html>