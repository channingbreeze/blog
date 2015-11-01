<?php 

session_start();
if(!isset($_SESSION['username'])) {
	header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <link href="../css/global.css" rel="stylesheet"></link>
        <link href="../css/common.css" rel="stylesheet"></link>
        <link href="../css/blogAdmin.css" rel="stylesheet"></link>
        <script src="../js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<h1 class="blogAdminTitle">管理后台</h1>
    	<ul class="manageUl">
    		<li><a href="blogManage.php">博客管理</a></li>
    		<li><a href="writeBlog.php">写博客</a></li>
    		<li><a href="smallTypeManage.php">调整技术博客类型顺序</a></li>
        </ul>
        <script src="../js/blogAdmin.js"></script>
    </body>
</html>