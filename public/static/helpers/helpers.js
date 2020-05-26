/*
* 原生ajax提交
* @param type 提交方式 get、post
* @param url 提交地址 
* @param data 提交数据
* @param success 提交成功回调方法
* @param error 失败回调方法
*
* @example
            Ajax('post', "{{ route('index.image') }}", {idx: 2, _token: '{{ csrf_token() }}'}, function(data) {
                console.log(data);
            }, function(data) {
                console.log(data);
            });
*/

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

