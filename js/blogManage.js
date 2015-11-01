(function($){
	
	$("a.deleteBlog").on('click', function(e){
		$this = $(this);
		var res = window.confirm('真的要删除该博客吗？');
		if(res) {
			$.post('../inter/admin/deleteBlog.php', {id: $this.data('id')}, function(data) {
				if(data == "success") {
					window.location.reload();
				} else {
					window.alert('删除失败');
				}
			});
		} else {
			console.log('canceled');
		}
	});
	
	$("#subRecomend").on('click', function(e){
		var id = $("#recomendId").val();
		$.post('../inter/admin/setRecomentId.php', {id: id}, function(data) {
			if(data == "success") {
				window.location.reload();
			} else {
				window.alert('更新失败');
			}
		});
	});
	
})(jQuery);