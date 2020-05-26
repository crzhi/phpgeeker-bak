//登录提交
function login(event) {
	event.preventDefault();
	var type = document.getElementById('form').getAttribute('method'),
		url = document.getElementById('form').getAttribute('action'),
		_token = document.getElementsByName("_token")[0].value,
		username = document.getElementsByName("username")[0].value,
		password = document.getElementsByName("password")[0].value;
	var data = {_token:_token, username:username,password:password};
	Ajax(type, url, data, function(data){
		var obj = JSON.parse(data);
		createButterbar(obj.message);
		if(obj.url) {
			setTimeout('window.location.href="'+obj.url+'"', 2000);
		}
	})
}

//原生ajax
function Ajax(type, url, data, success, error){
    var xhr = null;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject('Microsoft.XMLHTTP')
    }		 
    var type = type.toUpperCase();
    var random = Math.random();		 
    if(typeof data == 'object'){
        var str = '';
        for(var key in data){
            str += key+'='+data[key]+'&';
        }
        data = str.replace(/&$/, '');
    }		 
    if(type == 'GET'){
        if(data){
            xhr.open('GET', url + '?' + data, true);
        } else {
            xhr.open('GET', url + '?t=' + random, true);
        }
        xhr.send();		
    } else if(type == 'POST'){
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                success(xhr.responseText);
            } else {
                if(error){
                    error(xhr.status);
                }
            }
        }
    }
}

function clearButterbar() {
	var body = document.body,
		butter = document.getElementsByClassName("butterBar")
    if (butter.length > 0) {
        body.removeChild(butter[0]);
    }
}

function createButterbar(data) {
    clearButterbar();
    var body = document.body,
    	message = document.createElement('p'),
    	butter = document.createElement('div');
    message.className = 'butterBar-message';
    message.innerHTML = data;
    butter.className = "butterBar butterBar-center is-active";
    butter.append(message);
    body.append(butter);
    setTimeout('clearButterbar()', 2000);
}