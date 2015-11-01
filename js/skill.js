(function($){
	
	$(".blog").on('click', function(e){
		$this = $(this);
		var id = $this.data('id');
		window.location = "blog-" + id + ".html";
	});
	
})(jQuery);