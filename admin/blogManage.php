<?php 

session_start();
if(!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}

require_once dirname ( __FILE__ ) . '/../services/blogService.class.php';

$blogService = new BlogService();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <link href="../css/global.css" rel="stylesheet"></link>
        <link href="../css/common.css" rel="stylesheet"></link>
        <link href="../css/blogManage.css" rel="stylesheet"></link>
        <script src="../js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<h1 class="blogManageTitle">博客管理平台</h1>
    	<div class="recomendDiv">
    		<span>请输入推荐文章的id：</span>
	    	<input type="text" id="recomendId" value="<?php echo $blogService->getRecomendId();?>"/>
	    	<button id="subRecomend">提交</button>
    	</div>
    	<table class="blogManageTable" border="1px" cellspacing="0px">
    		<tr><th>id</th><th>title</th><th>readCount</th><th>blog_big_type</th><th>blog_small_type</th><th>small_type_order</th><th>show_order</th><th>操作</th></tr>
    		<?php 
    		$blogs = $blogService->getBlogs();
    		foreach ($blogs as $blog) {
			?>
			<tr>
				<td><?php echo $blog['id'];?></td>
				<td><?php echo $blog['title'];?></td>
				<td><?php echo $blog['readCount'];?></td>
				<td><?php echo $blog['blog_big_type'];?></td>
				<td><?php echo $blog['blog_small_type'];?></td>
				<td><?php echo $blog['small_type_order'];?></td>
				<td><?php echo $blog['show_order'];?></td>
				<td><a href="../blog-<?php echo $blog['id'];?>.html">查看</a>
					<a href="writeBlog.php?id=<?php echo $blog['id'];?>">编辑</a>
					<a href="javascript:void(0);" class="deleteBlog" data-id="<?php echo $blog['id'];?>">删除</a>
				</td>
			</tr>
			<?php
			}
    		?>
    	</table>
        <script src="../js/blogManage.js"></script>
    </body>
</html>