(function($){
	
	//删除左右两端的空格
	var trim = function(str) {
		return str.replace(/(^\s*)|(\s*$)/g, "");
　　 }
	
	$("#submit").on('click', function(e) {
		e.preventDefault();
		if(!trim($("#username").val())) {
			window.alert("请填写用户名！");
			return;
		}
		if(!trim($("#content").val())) {
			window.alert("请填写评论！");
			return;
		}
		$.post('inter/submitComment.php', $("#commentForm").serialize(), function(data) {
			if(data == "true") {
				window.location.reload();
			} else {
				window.alert("评论提交失败！");
			}
		});
	});
	
})(jQuery);