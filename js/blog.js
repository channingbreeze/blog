(function($){
	
	$("#submit").on('click', function(e) {
		e.preventDefault();
		$.post('inter/submitComment.php', $("#commentForm").serialize(), function(data) {
			if(data == "true") {
				window.location.reload();
			} else {
				window.alert("评论提交失败！");
			}
		});
	});
	
})(jQuery);