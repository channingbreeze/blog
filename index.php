<?php 

require_once dirname ( __FILE__ ) . '/services/blogService.class.php';
require_once dirname ( __FILE__ ) . '/services/tagService.class.php';

$blogService = new BlogService();
$tagService = new TagService();

$recomentedBlog = $blogService->getRecomentedBlog();
$newestBlog = $blogService->getNewestBlog();

$tags = $tagService->getTags();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <meta name="Keywords" content="李欣个人博客，李欣，个人博客，博客，程序员，全栈工程师" />
		<meta name="Description" content="李欣的个人博客记录平时工作中用到的技术并将其扩展，同时记录生活中的点点滴滴，是一个原创的个人博客" />
        <link href="css/global.css" rel="stylesheet"></link>
        <link href="css/common.css" rel="stylesheet"></link>
        <link href="css/index.css" rel="stylesheet"></link>
        <script src="js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<?php include_once 'partials/header.php'; ?>
        <div class="middlediv">
            <div class="leftdiv">
                <div class="subtitle">推荐好文</div>
                <ul class="blog recommented">
                    <li class="oneblog" data-id="<?php echo $recomentedBlog['id'];?>">
                    	<div class="title"><?php echo $recomentedBlog['title'];?></div>
                    	<?php 
                    	$tagArr = explode(' ', $recomentedBlog['tags']);
                    	?>
                    	<ul class="tags">
                    		<?php 
                    		foreach($tagArr as $tag) {
                    		?>
                    		<li><?php echo $tag;?></li>
                    		<?php 
                    		}
                    		?>
                    	</ul>
                    	<div class="clear"></div>
                    	<img src="<?php echo $recomentedBlog['img_url'];?>"/>
                    	<div class="abstract"><?php echo $recomentedBlog['abstract'];?></div>
                    	<div class="clear"></div>
                    	<div class="info"><?php echo $recomentedBlog['readCount'];?>次阅读&nbsp;&nbsp;<?php echo $recomentedBlog['gmt_modify'];?></div>
                    </li>
                </ul>
                <div class="clear"></div>
                <div class="subtitle">最新文章</div>
                <ul class="blog newest">
                    <li class="oneblog" data-id="<?php echo $newestBlog['id'];?>">
                    	<div class="title"><?php echo $newestBlog['title'];?></div>
                    	<?php 
                    	$tagArr = explode(' ', $newestBlog['tags']);
                    	?>
                    	<ul class="tags">
                    		<?php 
                    		foreach($tagArr as $tag) {
                    		?>
                    		<li><?php echo $tag;?></li>
                    		<?php 
                    		}
                    		?>
                    	</ul>
                    	<div class="clear"></div>
                    	<img src="<?php echo $newestBlog['img_url'];?>"/>
                    	<div class="abstract"><?php echo $newestBlog['abstract'];?></div>
                    	<div class="clear"></div>
                    	<div class="info"><?php echo $newestBlog['readCount'];?>次阅读&nbsp;&nbsp;<?php echo $newestBlog['gmt_modify'];?></div>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="rightdiv">
            	<div class="personalInfo">
            		<div class="ownerTag">站长标签</div>
	                <ul>
                		<li class="spec">全栈工程师</li>
                		<li>阳光宅男</li>
                		<li>安静</li>
                		<li>持续学习者</li>
                		<li class="spec">阿里巴巴在职</li>
                		<li>欢迎交流</li>
                		<li>最爱JS</li>
                		<li class="spec">推理控</li>
                		<li class="spec">慕课网认证讲师</li>
                		<li>乐于分享</li>
                		<li>代码洁癖</li>
                		<li class="spec">北航硕士</li>
                		<li>勇于尝试</li>
                	</ul>
                </div>
                <div class="clear"></div>
                <div class="tagCloud">
                	<div class="ownerTag">博客标签</div>
                	<ul>
                	<?php 
                	foreach($tags as $tag) {
					?>
						<li><?php echo $tag['tagname'];?></li>
					<?php 
					}
                	?>
                	</ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear mgbt30"></div>
        <?php include_once 'partials/footer.php'; ?>
        <script src="js/index.js"></script>
    </body>
</html>