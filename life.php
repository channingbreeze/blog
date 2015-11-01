<?php 
	
require_once dirname ( __FILE__ ) . '/services/blogService.class.php';

$blogService = new BlogService();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <meta name="Keywords" content="李欣个人博客，李欣，个人博客，博客，程序员，全栈工程师，生活" />
		<meta name="Description" content="李欣的个人博客记录平时工作中用到的技术并将其扩展，同时记录生活中的点点滴滴，是一个原创的个人博客" />
        <link href="css/global.css" rel="stylesheet"></link>
        <link href="css/common.css" rel="stylesheet"></link>
        <link href="css/life.css" rel="stylesheet"></link>
        <script src="js/lib/jquery.min.js"></script>
        <script src="js/lib/handlebars.js"></script>
        <script id="blog-template" type="text/x-handlebars-template">
        <ul>
			{{#each this}}
    		<li class="oneblog" data-id="{{id}}">
    			<div class="innerdiv">
    				<h1>{{title}}</h1>
    				<ul class="tags">
						{{#each tags}}
    					<li>{{this}}</li>
						{{/each}}
    				</ul>
    				<div class="clear"></div>
    				<img src="{{img_url}}"/>
    				<p>{{abstract}}</p>
    				<div class="info">{{readCount}}次阅读&nbsp;&nbsp;{{gmt_modify}}</div>
    				<div class="clear"></div>
    			</div>
    		</li>
			{{/each}}
		</ul>
    	</script>
    	<script id="pag-template" type="text/x-handlebars-template">
        <ul>
            {{#each this}}
            <li data-id={{index}} {{#if clickable}}class="clickable"{{/if}} {{#if cur}}class="cur"{{/if}}>{{{text}}}</li>
            {{/each}}
        </ul>
    	</script>
    </head>
    <body>
    	<?php include_once 'partials/header.php'; ?>
    	<div class="middlediv" id="blogs">
    		
    	</div>
    	<div class="pag" id="pag">
    		
    	</div>
    	<?php include_once 'partials/footer.php'; ?>
        <script src="js/life.js"></script>
    </body>
</html>