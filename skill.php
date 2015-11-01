<?php 

require_once dirname ( __FILE__ ) . '/services/blogService.class.php';

$blogService = new BlogService();
$blogs = $blogService->getSkillBlog();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <meta name="Keywords" content="李欣个人博客，李欣，个人博客，博客，程序员，全栈工程师，技术" />
		<meta name="Description" content="李欣的个人博客记录平时工作中用到的技术并将其扩展，同时记录生活中的点点滴滴，是一个原创的个人博客" />
        <link href="css/global.css" rel="stylesheet"></link>
        <link href="css/common.css" rel="stylesheet"></link>
        <link href="css/skill.css" rel="stylesheet"></link>
        <script src="js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<?php include_once 'partials/header.php'; ?>
    	<div class="middlediv">
    	<?php 
    	$isFirst = true;
    	foreach($blogs as $type => $blogArr) {
		?>
			<label for="<?php echo $type;?>"><?php echo $type;?></label>
            <span></span><input id="<?php echo $type;?>" type="radio" name="blog" <?php if($isFirst) { echo "checked"; $isFirst=false;}?> />
            <div class="blogs">
            	<?php 
            	$isFirst = true;
            	foreach($blogArr as $blog) {
				?>
				<label class="blogTitle" for="<?php echo $type . $blog['id'];?>"><?php echo $blog['title'];?></label>
                <span></span><input id="<?php echo $type . $blog['id'];?>" type="radio" name="<?php echo $type;?>" <?php if($isFirst) { echo "checked"; $isFirst=false;}?> />
                <div class="blog" data-id="<?php echo $blog['id'];?>" >
                    <ul class="blogTags">
                        <?php 
                        $tags = explode(' ', $blog['tags']);
                        foreach($tags as $tag) {
						?>
						<li><?php echo $tag;?></li>
						<?php 
						}
                        ?>
                    </ul>
                    <div class="clear"></div>
                    <img src="<?php echo $blog['img_url'];?>" />
                    <div class="subTitle"><?php echo $blog['abstract'];?></div>
                    <div class="clear"></div>
                    <div class="info"><?php echo $blog['readCount'];?>次阅读&nbsp;&nbsp;<?php echo $blog['gmt_modify'];?></div>
                </div>
				<?php 
				}
            	?>
            </div>
		<?php 
		}
    	?>
    	</div>
    	<?php include_once 'partials/footer.php'; ?>
        <script src="js/skill.js"></script>
    </body>
</html>