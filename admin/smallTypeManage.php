<?php 

session_start();
if(!isset($_SESSION['username'])) {
	header("Location: ../index.php");
}

require_once dirname ( __FILE__ ) . '/../services/blogService.class.php';

$blogService = new BlogService();
$blogTypes = $blogService->getSmallType();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>李欣的个人博客</title>
        <meta charset="utf-8" />
        <link href="../css/global.css" rel="stylesheet"></link>
        <link href="../css/common.css" rel="stylesheet"></link>
        <link href="../css/smallTypeManage.css" rel="stylesheet"></link>
        <script src="../js/lib/jquery.min.js"></script>
    </head>
    <body>
    	<h1 class="smallTypeManageTitle">博客小类型管理平台</h1>
    	<table class="smallTypeTable">
    		<tr><th>small type</th><th>order</th><th>operate</th></tr>
    	<?php 
    	foreach($blogTypes as $key => $blogType) {
		?>
			<tr>
				<td><?php echo $blogType['blog_small_type'];?></td>
				<td><input id="<?php echo "input" . $key;?>" type="text" value="<?php echo $blogType['small_type_order'];?>" /></td>
				<td><button class="modify" data-id="<?php echo "input" . $key;?>" data-type="<?php echo $blogType['blog_small_type'];?>">修改</button></td>
			</tr>
		<?php 
		}
    	?>
    	</table>
        <script src="../js/smallTypeManage.js"></script>
    </body>
</html>