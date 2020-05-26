<?php

/** 
*辅助函数
* 
*公共辅助函数，系统模块通用 
*
* @author      phpgeeker
* @version     1.0
*/ 

	if (!function_exists('modules_domain')) {
		/**  
		* 设置/获取系统模块域名
		* 
		* @param $prefix 二级域名前缀
		* @return string 完整域名
		*/ 
		function modules_domain ($prefix = null)
		{
			$domain = config('app.url');
			if($prefix) {
				$domain = str_replace('://', '://' . $prefix . '.', $domain);
			}
			return $domain;
		}
	}

	if (!function_exists('route_class')) {
		/**  
		* 将当前请求的路由名称转换为 CSS 类名称,允许我们针对某个页面做页面样式定制
		* 
		* @return string 完整类名
		*/ 
		function route_class()
		{
			return str_replace('.', '-', Route::currentRouteName());
		}
	}

	if(!function_exists('upload_base64_img')) {	
		/**
		 * base64图片转img
		 * @param string $base64 base64图片
		 * @param String $pathName 文件夹路径
		 * @return String 图片路径
		 */
		function upload_base64_img($base64, $pathName = 'other', $date = true)
		{
			//post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
			$base64Image = str_replace(' ', '+', $base64);
			//匹配图片base64
			if (preg_match('/^(data:\s*image\/(\w+|\w-\w+);base64,)/', $base64Image, $result)) {
				//匹配格式
				if (!empty($result[2]) && !in_array($result[2], ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'x-icon'])) {
					return error('图片格式不合法');
				}
				//修改ico图片后缀
				$result[2]=='x-icon'?$result[2]='ico':'';
				//图片名
				$imageName = uniqid() . '.' . $result[2];
				//保存路径				
				if($date) {
					$path = public_path('uploads/' . $pathName . '/' . date('Y-m-d'));
				} else {
					$path = public_path('uploads/' . $pathName);
				}
				if (!file_exists($path)) {
					@mkdir($path, 0755, true);
				}
				//图片完整路径
				$imageFile = $path . '/' . $imageName;
				//服务器文件存储路径
				if (file_put_contents($imageFile, base64_decode(str_replace($result[1], '', $base64Image)))) {
					return '/uploads/' . str_replace(public_path('uploads/'), '', $path) . '/' . $imageName;
				}
			}
			return $base64;
		}
	}

	if (!function_exists('upload_file')) {
		/**
		 * 上传文件
		 *
		 * @param        $name            form 表单中的 name
		 * @param string $path            文件保存的目录 相对于 /public 目录
		 * @param array  $allowExtension  允许上传的文件后缀
		 * @param bool   $childPath       是否按日期创建目录
		 *
		 * @return array
		 */
		function upload_file($name, $path = 'other', $childPath = true, $allowExtension = [])
		{
			// 判断请求中是否包含name=file的上传文件
			if (!request()->hasFile($name)) {
			   return ['status_code' => 401,'message' => '上传文件为空'];
			}
			$file = request()->file($name);
			// 判断是否多文件上传
			if (!is_array($file)) {
				$file = [$file];
			}

			// 如果目录不存在；先创建目录
			$pathName = public_path('uploads/'. $path) . '/' . date('Y-m-d') . '/';
			is_dir($pathName) || mkdir($pathName, 0755, true);

			// 上传成功的文件
			$success = [];

			// 循环上传
			foreach ($file as $k => $v) {
				//判断文件上传过程中是否出错
				if (!$v->isValid()) {
					return ['status_code' => 500,'message' => '文件上传出错'];
				}
				// 获取上传的文件名
				$oldName = $v->getClientOriginalName();

				// 获取文件后缀
				$extension = strtolower($v->getClientOriginalExtension());

				// 判断是否是允许的文件类型
				if (!empty($allowExtension) && !in_array($extension, $allowExtension)) {
					return ['status_code' => 500,'message' => $oldName . '的文件类型不被允许'];
				}

				// 组合新的文件名
				$newName = uniqid() . '.' . $extension;

				// 判断上传是否失败
				if (!$v->move($pathName, $newName)) {
					return ['status_code' => 500,'message' => '保存文件失败'];
				} else {
					$success[] = [
						'name' => $oldName,
						'path' => '/uploads/'. str_replace(public_path('uploads/'), '', $pathName) . $newName
					];
				}
			}

			//上传成功
			$data=[
				'status_code' => 200,
				'message' => '上传成功',
				'data' => $success
			];
			return $data;
		}
	}

	if (!function_exists('markdown_to_html')) {
		/**
		* 把markdown转为html
		*
		* @param $markdown
		*
		* @return mixed|string
		*/
		function markdown_to_html($markdown)
		{
			// 正则匹配到全部的iframe
			preg_match_all('/&lt;iframe.*iframe&gt;/', $markdown, $iframe);
			// 如果有iframe 则先替换为临时字符串
			if (!empty($iframe[0])) {
				$tmp = [];
				// 组合临时字符串
				foreach ($iframe[0] as $k => $v) {
					$tmp[] = '【iframe' . $k . '】';
				}
				// 替换临时字符串
				$markdown = str_replace($iframe[0], $tmp, $markdown);
				// 讲iframe转义
				$replace = array_map(function ($v) {
					return htmlspecialchars_decode($v);
				}, $iframe[0]);
			}
			// markdown转html
			$parser = new HyperDown\Parser;
			$html   = $parser->makeHtml($markdown);
			$html   = str_replace('<code class="', '<code class="lang-', $html);
			// 将临时字符串替换为iframe
			if (!empty($iframe[0])) {
				$html = str_replace($tmp, $replace, $html);
			}

			return $html;
		}
	}

	if (!function_exists('success')) {
		function success ($message = '操作成功', $url = '') {
			$data = [
	            'code' => 1,
	            'message' => $message, 
	            'url' => $url,					
			];
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode($data));
		}
	}

	if (!function_exists('error')) {
		function error ($message = '操作失败', $url = '') {
			$data = [
	            'code' => 2,
	            'message' => $message, 
	            'url' => $url,					
			];
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode($data));
		}
	}