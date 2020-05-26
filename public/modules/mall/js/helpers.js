function tips(data) {
	// console.log(data)
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

function deleteTips(_this) {
	var url = _this.data('href');
	layer.confirm('是否确定删除？', {
	  btn: ['确定','取消'] //按钮
	}, function(){
		$.post(url,{_method:'delete'}, function(data){
			if(data.status='success') {
				tips(data);
			}
		})
	});	        												
}

function address_pcd(url, province, city, district){
	var form = layui.form,
	layer = layui.layer;
	getJSON(url,$("select[name='province']").closest("div"));
	form.on('select(state)', function(data){
		$that = $(data.elem);
		if(data.value != '') {
		    urls = url+"/"+$that.find("option:selected").attr("data-pid");
		    getJSON(urls,$that.closest("div").next());			
		} else {
			if($that.attr('name') == 'province') {
				clearSelect('city');
				clearSelect('district');
			}
			if($that.attr('name') == 'city') {
				clearSelect('district');
			}
			form.render()
		}
	});

	function getJSON(urls,even){
		// console.log(even)
		$.getJSON(urls, function(json){
			var pid = 0;
			var name = even.find("select").attr("name");
	        var select = "<select name=\"" + name + "\" lay-verify=\"required\" lay-filter=\"state\">";
	        select += "<option value=\"\">请选择</option>";
	        $(json).each(function(){
	        	select += "<option value=\"" + this.name + "\"data-pid=\"" + this.code + "\"";
	           	if(province == this.name || city == this.name || district == this.name){
	              select += " selected=\"selected\" ";
	              pid = this.code;
	            }
	            select += ">" + this.name + "</option>";
	        });
	        select += "</select>";
	        even.html(select);
	        var nextName = even.next().find("select").attr("name");
	        even.next().html("<select name=\"" + nextName + "\" lay-verify=\"required\" lay-filter=\"state\"><option value=\"\">请选择</option></select>");
	    	form.render('select');
	    	if(pid != 0){
	    		getJSON(url+"/"+pid,even.next());
	    	}
	  	});
	}
	
	function clearSelect(name) {
		var select = "<select name=\"" + name + "\" lay-verify=\"required\" lay-filter=\"state\">";
	    	select += "<option value=\"\">请选择</option>";
	    	select += "</select>";	        	
	    $("select[name='" + name + "']").html(select);
	}
}

/*
*功能： 模拟form表单的提交
*参数： URL 跳转地址 PARAMTERS 参数
*/
function post(URL, PARAMTERS) {
	var _token =$('meta[name="csrf-token"]').attr('content');
    //创建form表单
    var temp_form = document.createElement("form");
    temp_form.action = URL;
    //如需打开新窗口，form的target属性要设置为'_blank'
    temp_form.target = "_self";
    temp_form.method = "post";
    temp_form.style.display = "none";

    var csrf = document.createElement("textarea");
    csrf.name = '_token';
    csrf.value = _token;
    temp_form.appendChild(csrf);

    //添加参数
    for (var item in PARAMTERS) {
        var opt = document.createElement("textarea");
        opt.name = item;
        opt.value = PARAMTERS[item];
        temp_form.appendChild(opt);
    }
    document.body.appendChild(temp_form);
    //提交数据
    temp_form.submit();    
}


// 遍历解析Json
function parseJson(jsonObj) {
    // 循环所有键
    for(var key in jsonObj) {
        //如果对象类型为object类型且数组长度大于0 或者 是对象 ，继续递归解析
        var element = jsonObj[key];
        if(element.length > 0 && typeof(element) == "object" || typeof(element) == "object") {
            parseJson(element);
        } else { //不是对象或数组、直接输出
            return key + ":" + element;
        }

    }
}
