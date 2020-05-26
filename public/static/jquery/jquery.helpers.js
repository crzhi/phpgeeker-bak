
function toast(data) {
    layer.msg(data.message, {icon:data.code});
    if(data.url) {
    	if(data.url == 'refresh') {
    		setTimeout(function(){ 
				window.location.reload() 
			}, 1500);
    	} else {
			setTimeout(function(){ 
				window.location.href = data.url;
			}, 1500);
		}		                	
    }
}

$(".pg-restore-btn").on('click', function() {
	var url = $(this).data('href'),
		id = $(this).data('id');
	layer.confirm('是否确定还原？', {
	  btn: ['确定','取消']
	}, function(){
		$.post(url,{_method:'put', id:id}, function(data){
			toast(data);
		})
	});
})

$(".pg-delete-btn").on('click', function() {
	var url = $(this).data('href');
	layer.confirm('是否确定删除？', {
	  btn: ['确定','取消']
	}, function(){
		$.post(url,{_method:'delete'}, function(data){
			toast(data);
		})
	});
})

$(".pg-destory-btn").on('click', function() {
	var url = $(this).data('href'),
		id = $(this).data('id');
	layer.confirm('是否确定彻底删除？', {
	  btn: ['确定','取消']
	}, function(){
		$.post(url,{_method:'delete', id:id}, function(data){
			toast(data);
		})
	});
})

$('.pg-upload-btn').on('change', function() {
	var _this = $(this);
	var previewBox = _this.parent().prev();
	previewBox.html('');
	var reader = new FileReader();
	reader.onload = function(evt){
		imgSrc = evt.target.result;
		_this.prev().attr('value', imgSrc);
		previewBox.append('<img src="'+imgSrc+'" height="200">');
	}
	reader.readAsDataURL(this.files[0]);
})