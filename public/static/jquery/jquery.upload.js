~ (function(win) {
    // var htmls = '<input type="file" class="imgFiles" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" multiple>'
    // 			+ '<div id="imgClick">选择图片'
    // 			+ '</div>';
    var ImgUploadeFile = function(obj, fn) {
        var _this = this;
        this.bom = document.querySelector(obj);
        if (fn) fn.call(_this);
        this.ready();
    };
    ImgUploadeFile.prototype = {
        init: function(o) {
            this.MAX = o.MAX || 5;
            this.callback = o.callback;
            this.MW = o.MW || 10000;
            this.MH = o.MH || 10000;
        },
        ready: function() {
            var _self = this;
            this.dom = document.createElement('div');
            this.dom.className = 'imgFileUploade';
            // this.dom.innerHTML = htmls;
            this.bom.appendChild(this.dom);
            this.files = this.bom.querySelector('.imgFiles');
            this.fileClick = this.bom.querySelector('#imgClick');
            var imgSrc = document.getElementById('image-box-input').value;
            if(imgSrc) {
                this.imgDom = document.getElementById("imgClick")
                this.imgDom.innerHTML = '    <img src="' + imgSrc + '" class="imsg">';
            }
            this.fileBtn(this.fileClick, this.files);
            // this.imgcontent = this.bom.querySelector('.imgcontent');
            // this.imgcontent.innerHTML = '请上传<b style="color:red">' + this.MAX + '</b>张' + _self.MW + ' * ' + _self.MH + '像素的图片';
        },
        fileBtn: function(c, f) {
            var _self = this;
            var _imgAll = $(c).parent().parent().find('#imgClick');
            $(c).off().on('click',
            function() {
                $(f).click();
                $(f).off().on('change',
                function() {
                    var _this = this;
                    _private.startUploadImg(_imgAll, _this.files, _self.MAX, _self.callback, _self.MW, _self.MH);
                });
            });
        }
    };
    var _dataArr = [];
    var _private = {
        startUploadImg: function(o, files, MAX, callback, W, H) {
            _dataArr.length = 0;
            var _this = this;
            var fileImgArr = [];
            if (files.length > MAX) {
                alert('不能大于' + MAX + '张');
                return false;
            };
            var lens = $(o).find('li').length;
            if (lens >= MAX) {
                alert('不能大于' + MAX + '张');
                return false;
            };
            for (var i = 0,
            file; file = files[i++];) {
                var reader = new FileReader();
                reader.onload = (function(file) {
                    return function(ev) {
                        var image = new Image();
                        image.onload = function() {
                            var width = image.width;
                            var height = image.height;
                            fileImgArr.push({
                                fileSrc: ev.target.result,
                                fileName: file.name,
                                fileSize: file.size,
                                height: height,
                                width: width
                            });
                        };
                        image.src = ev.target.result;
                    };
                })(file);
                reader.readAsDataURL(file);
            }
            var imgTimeSlice = _this.timeChunk(fileImgArr,
            function(file) {
                if (file.width > W || file.height > H) {
                    alert('图片不能大于' + W + '*' + H + '像素');
                    return false;
                }
                var up = new ImgFileupload(o, file.fileName, file.fileSrc, file.fileSize, callback);
                up.init();
            },
            1);
            imgTimeSlice();
        },
        timeChunk: function(arr, fn, count) {
            var obj, t;
            var len = arr.length;
            var start = function() {
                for (var i = 0; i < Math.min(count || 1, arr.length); i++) {
                    var obj = arr.shift();
                    fn(obj)
                }
            };
            return function() {
                t = setInterval(function() {
                    if (arr.length === 0) {
                        return clearInterval(t);
                    }
                    start();
                },
                200)
            }
        }
    };
    var ImgFileupload = function(b, imgName, imgSrc, imgSize, callback) {
        this.b = b;
        this.imgName = imgName;
        this.imgSize = imgSize;
        this.imgSrc = imgSrc;
        this.callback = callback;
    };
    ImgFileupload.prototype.init = function() {
        var _self = this;
        this.dom = document.getElementById("imgClick")
        this.dom.innerHTML = '    <img src="' + this.imgSrc + '" alt="' + this.imgName + '" class="imsg">';
        // $(this.dom).attr({
        //     'data-delName': this.imgName
        // });
        $(this.b).append(this.dom);
        var _Img = new Image();
        // _Img.src = $(this.dom).find('img').attr('data-src');
        _Img.onload = function() {
            $(_self.dom).find('img').attr('src', _Img.src);
        }
        _dataArr.push({
            src: this.imgSrc
        });
        _self.callback(_dataArr);
    }
    win.ImgUploadeFile = ImgUploadeFile;
})(window);