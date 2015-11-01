(function($){
	
	$(".tagCloud li").each(function() {
		$this = $(this);
		$this.css('color', '#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6));
		$this.css('fontSize', (Math.floor(Math.random()*10) + 20) + 'px');
	});
	
	$(".oneblog").on('click', function(e) {
		$this = $(this);
        var id = $this.data('id');
        window.location.href="blog-" + id + ".html";
	});
	
})(jQuery);