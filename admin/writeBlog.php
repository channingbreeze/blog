<?php 

session_start();
if(!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';
require_once dirname ( __FILE__ ) . '/../services/blogService.class.php';

$blogService = new BlogService();

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sqlHelper = new SQLHelper();
	$sql = "select * from lx_blog where id=" . $id;
	$res = $sqlHelper->execute_dql_array($sql);
	if(count($res) == 0) {
		$update = false;
	} else {
		$update = true;
		$blog = $res[0];
	}
} else {
	$update = false;
}

if(!$update) {
	$order = $blogService->getMaxOrder() + 10;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <link href="../css/global.css" rel="stylesheet"></link>
        <link href="../css/common.css" rel="stylesheet"></link>
        <link href="../css/writeBlog.css" rel="stylesheet"></link>
        <script src="../ueditor/ueditor.config.js"></script>
        <script src="../ueditor/ueditor.all.min.js"></script>
        <script src="../ueditor/ueditor.parse.min.js"></script>
        <script src="../js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<h1 class="writeBlogTitle">博客编辑平台</h1>
    	<form class="blogInfo" id="blogForm">
    		<?php 
    		if($update) {
    		?>
    		<div class="line"><span class="title">更新博客：</span><input type="hidden" name="id" value="<?php if($update) {echo $blog['id'];}?>" /></div>
    		<?php 
    		} else {
    		?>
    		<div class="line"><span class="title">增加博客：</span></div>
    		<?php 
    		}
    		?>
	    	<div class="line"><span class="title">关键词：</span><input type="text" name="keywords" value="<?php if($update) {echo $blog['keywords'];}?>" /></div>
			<div class="line"><span class="title">描述：</span><input type="text" name="description" value="<?php if($update) {echo $blog['description'];}?>" /></div>
			<div class="line"><span class="title">博客图片路径：</span><input type="text" name="picurl" value="<?php if($update) {echo $blog['img_url'];}?>" />(240x135 px)</div>
			<div class="line"><span class="title">标题：</span><input type="text" name="title" value="<?php if($update) {echo $blog['title'];}?>" /></div>
			<div class="line"><span class="title">摘要(80字左右)：</span><input type="text" name="abstract" value="<?php if($update) {echo $blog['abstract'];}?>" /></div>
			<div class="line"><span class="title">标签(空格隔开)：</span><input type="text" name="tags" value="<?php if($update) {echo $blog['tags'];}?>" /></div>
			<div class="line">
				<span class="title">大分类：</span>
				<!-- <input type="text" name="bigtype" value="<?php if($update) {echo $blog['blog_big_type'];}?>" /> -->
				<select name="bigtype">
					<?php
					if($update) {
						if($blog['blog_big_type'] == "技术") {
					?>
					<option value="技术" selected>技术</option>
					<option value="生活">生活</option>
					<?php
						} else {
					?>
					<option value="技术">技术</option>
					<option value="生活" selected>生活</option>
					<?php
						}
					} else {
					?>
					<option value="技术" selected>技术</option>
					<option value="生活">生活</option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="line"><span class="title">小分类：</span>
				<select id="smallTypeSelect">
					<option>请选择</option>
					<?php 
						$types = $blogService->getSmallType();
						foreach($types as $type) {
					?>
					<option><?php echo $type['small_type_order'] . "-" . $type['blog_small_type'];?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="line"><span class="title">小分类（名字）：</span><input type="text" id="smalltypeName" name="smalltype" value="<?php if($update) {echo $blog['blog_small_type'];}?>" /></div>
			<div class="line"><span class="title">小分类（顺序）：</span><input type="text" id="smalltypeOrder" name="smalltypeorder" value="<?php if($update) {echo $blog['small_type_order'];}?>" /></div>
			<div class="line"><span class="title">顺序：</span><input type="text" name="showorder" value="<?php if($update) {echo $blog['show_order'];} else {echo $order;}?>" /></div>
		</form>
        <div class="blogInfo">
        	<div class="line"><span class="title">图片上传：</span><input id="pic" type="file" name="pic" /><button id="uploadPic">选择图片</button><span id="picUrl"></span></div>
        </div>
        <textarea class="writeBlogEditor" name="content" id="myEditor" data-value='<?php if($update) {echo $blog["content"];}?>'></textarea>
        <button class="writeBlogBtn" id="preBtn">预览</button>
        <button class="writeBlogBtn" id="subBtn">提交</button>
        <div class="middlediv">
        	<div class="content">
        		<hr />
        		<div id="pre" class="blogContent"></div>
        	</div>
        </div>
        <div class="h300"></div>
        <script src="../js/writeBlog.js"></script>
    </body>
</html>