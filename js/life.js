(function($){
	
	refreshBlogs(1);
	bindPageEvent();
	bindBlogEvent();
	
    function refreshBlogs(curPage) {
        $.getJSON('inter/getLifeBlogs.php', 'page='+curPage, function(data){
        	renderTemplate("#blog-template", formatBlog(data.blogs), "#blogs");
            renderTemplate("#pag-template", formatPag(data), "#pag");
        });
    };
	
    function bindPageEvent() {
        $("#pag").delegate('li.clickable', 'click', function(e){
            $this = $(this);
            refreshBlogs($this.data('id'));
        });
    };
    
    function bindBlogEvent() {
        $("#blogs").delegate('li', 'click', function(e){
            $this = $(this);
            var id = $this.data('id');
            window.location.href="blog-" + id + ".html";
        });
    };
    
    function renderTemplate(templateSelector, data, htmlSelector) {
        var template = $(templateSelector).html();
        var classHtml = Handlebars.compile(template)(data);
        $(htmlSelector).html(classHtml);
    };
	
    function formatPag(pagData) {
        var arr = [];
        var total = parseInt(pagData.totalPage);
        var cur = parseInt(pagData.curPage);

        var toLeft = {};
        toLeft.index = 1;
        toLeft.text = '&laquo;';
        if(cur != 1) {
            toLeft.clickable = true;
        }
        arr.push(toLeft);

        var pre = {};
        pre.index = cur - 1;
        pre.text = '&lsaquo;';
        if(cur != 1) {
            pre.clickable = true;
        }
        arr.push(pre);

        if(cur <= 5) {
            for(var i=1; i<cur; i++) {
                var pag = {};
                pag.text = i;
                pag.index = i;
                pag.clickable = true;
                arr.push(pag);
            }
        } else {

            var pag = {};
            pag.text = 1;
            pag.index = 1;
            pag.clickable = true;
            arr.push(pag);
            var pag = {};
            pag.text = '…';
            arr.push(pag);
            for(var i=cur-2; i<cur; i++) {
                var pag = {};
                pag.text = i;
                pag.index = i;
                pag.clickable = true;
                arr.push(pag);
            }
        }

        var pag = {};
        pag.text = cur;
        pag.index = cur;
        pag.cur = true;
        arr.push(pag);

        if(cur >= total-4) {
            for(var i=cur+1; i<=total; i++) {
                var pag = {};
                pag.text = i;
                pag.index = i;
                pag.clickable = true;
                arr.push(pag);
            }
        } else {

            for(var i=cur+1; i<=cur+2; i++) {
                var pag = {};
                pag.text = i;
                pag.index = i;
                pag.clickable = true;
                arr.push(pag);
            }
            var pag = {};
            pag.text = '…';
            arr.push(pag);
            var pag = {};
            pag.text = total;
            pag.index = total;
            pag.clickable = true;
            arr.push(pag);
        }

        var next = {};
        next.index = cur + 1;
        next.text = '&rsaquo;';
        if(cur != total) {
            next.clickable = true;
        }
        arr.push(next);

        var toRight = {};
        toRight.index = total;
        toRight.text = '&raquo;';
        if(cur != total) {
            toRight.clickable = true;
        }
        arr.push(toRight);
        return arr;
    };

    function formatBlog(blog) {
    	var res = [];
    	for(var i=0; i<blog.length; i++) {
    		blog[i].tags = blog[i].tags.split(" ");
    		res.push(blog[i]);
    	}
    	return res;
    }
	
})(jQuery);