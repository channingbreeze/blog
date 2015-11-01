(function($){
	
	$(".modify").on('click', function() {
		$this = $(this);
		var id = $this.data("id");
		var type = $this.data("type");
		var order = $("#" + id).val();
		$.post("../inter/admin/updateSmallType.php", {type: type, order: order}, function(data) {
			if(data == "success") {
				window.location.reload();
			} else {
				window.alert("更新失败！");
			}
		});
	});
	
})(jQuery);