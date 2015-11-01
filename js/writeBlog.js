(function($){
	
	// ueditor相关
	UEDITOR_CONFIG.UEDITOR_HOME_URL = '../ueditor/'; //一定要用这句话，否则你需要去ueditor.config.js修改路径的配置信息
    var editor = UE.getEditor('myEditor');
    uParse('.content',{
        'liiconpath':'/blog/ueditor/themes/list/'    //使用 '/' 开头的绝对路径
    });
    var content = $("#myEditor").data('value');
    if(content) {
    	setTimeout(function() {
    		editor.setContent(content);
    		$("#preBtn").click();
    	}, 500);
    }
    $("#preBtn").on('click', function() {
        $("#pre").html(editor.getContent());
    });
    
    // 上传图片
    $("#uploadPic").on('click', function(e) {
    	e.preventDefault();
    	$("#pic").click();
    });
    
    $("#pic").on('change', function(e) {
    	var fd = new FormData();
        fd.append(this.name, this.files[0]);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../inter/admin/uploadPic.php', true);
        xhr.upload.onprogress = function (ev) {
        	percent = 100 * ev.loaded / ev.total;
        	$("#picUrl").html(percent);
        }
        xhr.onload = function() {
        	if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                	$("#picUrl").html(xhr.responseText);
                }
        	}
        }
        xhr.send(fd);
    });
    
    // 提交博客
    $("#subBtn").on('click', function(e) {
    	var params = $("#blogForm").serialize() + '&blog=' + editor.getContent();
    	$.post('../inter/admin/submitBlog.php', params, function(data) {
    		if(data == "success") {
    			window.alert('提交成功');
    		} else {
    			window.alert('提交失败');
    		}
    	});
    	
    });
    
    // 博客小分类的选择
    $("#smallTypeSelect").on('change', function(e){
    	var val = $(this).val();
    	var vals = val.split('-');
    	$("#smalltypeName").val(vals[1]);
    	$("#smalltypeOrder").val(vals[0]);
    });
	
})(jQuery);