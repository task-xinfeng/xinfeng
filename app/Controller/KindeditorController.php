<?php
App::uses('AppController', 'Controller');

class KindeditorController extends AppController
{
    var $name    = 'Kindeditor';
    var $helpers = array('Html', 'Form','Ajax','Javascript');
	var $components  = array('RequestHandler');
	var $uses = array();

	
	function fileManagerJson(){
		/**
		 * KindEditor PHP
		 * 
		 * 本PHP程序是演示程序，建议不要直接在实际项目中使用。
		 * 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
		 * 
		 */
		
		App::import('vendor', 'kindeditor/JSON',false);
		//App::import("Vendor", "Services_JSON", false, null, 'JSON.php');
		//App::import('Vendor', 'kindeditor', array('file' => 'phpThumb'.DS.'phpthumb.class.php'));
		header('Content-type: application/json; charset=UTF-8');
		$json = new Services_JSON();
		 
		$php_path = dirname(__FILE__) . '/';
		$php_url = dirname($_SERVER['PHP_SELF']) . '/';
		
		//根目录路径，可以指定绝对路径，比如 /var/www/attached/
		$root_path = $php_path . '/'.CAKE_ROOT_NAME.'/app/webroot/img/attached/';
		//根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
		$root_url = $php_url . '/'.CAKE_ROOT_NAME.'/app/webroot/img/attached/';
		//图片扩展名
		$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		
		//根据path参数，设置各路径和URL
		if (empty($_GET['path'])) {
			$current_path = realpath($root_path) . '/';
			$current_url = $root_url;
			$current_dir_path = '';
			$moveup_dir_path = '';
		} else {
			$current_path = realpath($root_path) . '/' . $_GET['path'];
			$current_url = $root_url . $_GET['path'];
			$current_dir_path = $_GET['path'];
			$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
		}
		//排序形式，name or size or type
		$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);
		
		//不允许使用..移动到上一级目录
		if (preg_match('/\.\./', $current_path)) {
			echo 'Access is not allowed.';
			exit();
		}
		//最后一个字符不是/
		if (!preg_match('/\/$/', $current_path)) {
			echo 'Parameter is not valid.';
			exit();
		}
		//目录不存在或不是目录
		if (!file_exists($current_path) || !is_dir($current_path)) {
			echo 'Directory does not exist.';
			exit();
		}
		
		//遍历目录取得文件信息
		$file_list = array();
		if ($handle = opendir($current_path)) {
			$i = 0;
			while (false !== ($filename = readdir($handle))) {
				if ($filename{0} == '.') continue;
				$file = $current_path . $filename;
				if (is_dir($file)) {
					$file_list[$i]['is_dir'] = true; //是否文件夹
					$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
					$file_list[$i]['filesize'] = 0; //文件大小
					$file_list[$i]['is_photo'] = false; //是否图片
					$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
				} else {
					$file_list[$i]['is_dir'] = false;
					$file_list[$i]['has_file'] = false;
					$file_list[$i]['filesize'] = filesize($file);
					$file_list[$i]['dir_path'] = '';
					$file_ext = strtolower(array_pop(explode('.', trim($file))));
					$file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
					$file_list[$i]['filetype'] = $file_ext;
				}
				$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
				$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
				$i++;
			}
			closedir($handle);
		}
		
		//排序
		function cmp_func($a, $b) {
			global $order;
			if ($a['is_dir'] && !$b['is_dir']) {
				return -1;
			} else if (!$a['is_dir'] && $b['is_dir']) {
				return 1;
			} else {
				if ($order == 'size') {
					if ($a['filesize'] > $b['filesize']) {
						return 1;
					} else if ($a['filesize'] < $b['filesize']) {
						return -1;
					} else {
						return 0;
					}
				} else if ($order == 'type') {
					return strcmp($a['filetype'], $b['filetype']);
				} else {
					return strcmp($a['filename'], $b['filename']);
				}
			}
		}
		usort($file_list, 'cmp_func');
		
		$result = array();
		//相对于根目录的上一级目录
		$result['moveup_dir_path'] = $moveup_dir_path;
		//相对于根目录的当前目录
		$result['current_dir_path'] = $current_dir_path;
		//当前目录的URL
		$result['current_url'] = $current_url;
		//文件数
		$result['total_count'] = count($file_list);
		//文件列表数组
		$result['file_list'] = $file_list;
		
		//输出JSON字符串
		
		echo $json->encode($result);
	}
	
	function uploadJson(){
		/**
		 * KindEditor PHP
		 * 
		 * 本PHP程序是演示程序，建议不要直接在实际项目中使用。
		 * 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
		 * 
		 */
		
		//App::import("Vendor", "Services_JSON", false, null, 'JSON.php');
		App::import('vendor', 'kindeditor/JSON',false);
		header('Content-type: text/html; charset=UTF-8');
		$json = new Services_JSON();
		
		//文件保存目录路径
		$save_path = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . '/app/webroot/img/attached/';
		//debug($save_path);die();
		//$this->alert($save_path);
		//文件保存目录URL
		$save_url = $this->webroot  .'img/attached/';
		//定义允许上传的文件扩展名
		$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		//最大文件大小
		$max_size = 1000000;
		
		//有上传文件时
		if (empty($_FILES) === false) {
			//原文件名
			$file_name = $_FILES['imgFile']['name'];
			//服务器上临时文件名
			$tmp_name = $_FILES['imgFile']['tmp_name'];
			//文件大小
			$file_size = $_FILES['imgFile']['size'];
			//检查文件名
			if (!$file_name) {
				$this->alert("请选择文件。");
			}
			//检查目录
			if (@is_dir($save_path) === false) {
				$this->alert("上传目录不存在。");
			}
			//检查目录写权限
			if (@is_writable($save_path) === false) {
				$this->alert("上传目录没有写权限。");
			}
			//检查是否已上传
			if (@is_uploaded_file($tmp_name) === false) {
				$this->alert("临时文件可能不是上传文件。");
			}
			//检查文件大小
			if ($file_size > $max_size) {
				$this->alert("上传文件大小超过限制。");
			}
			//获得文件扩展名
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = trim($file_ext);
			$file_ext = strtolower($file_ext);
			//检查扩展名
			if (in_array($file_ext, $ext_arr) === false) {
				$this->alert("上传文件扩展名是不允许的扩展名。");
			}
			//新文件名
			$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
			//移动文件
			$file_path = $save_path . $new_file_name;
			if (move_uploaded_file($tmp_name, $file_path) === false) {
				$this->alert("上传文件失败。");
			}
			@chmod($file_path, 0644);
			$file_url = $save_url . $new_file_name;
			
			
			echo $json->encode(array('error' => 0, 'url' => $file_url));
			exit();
		}
	}
	
	function alert($msg) {
		App::import("Vendor", "Services_JSON", false, null, 'JSON.php');
		header('Content-type: text/html; charset=UTF-8');
		$json = new Services_JSON();
		echo $json->encode(array('error' => 1, 'message' => $msg));
		exit();
	}
}
?>