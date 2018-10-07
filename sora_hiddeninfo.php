<?php
/*
Plugin Name: Sora_HiddenInfo
Plugin URI: #
Description: 隐藏图片和文章浏览数、点赞数和附件下载数
Version: 1.2
Author: Sora
Author URI: http://www.pinnpinn.com/sora/index.html
*/
error_reporting(E_ALL^E_NOTICE^E_WARNING);//隐藏错误提示
function is_url($s) {
	return preg_match('/^http[s]?:\/\/'.
		'(([0-9]{1,3}\.){3}[0-9]{1,3}'. // IP形式的URL- 127.0.0.1
		'|'. // 允许IP和DOMAIN（域名）
		'([0-9a-z_!~*\'()-]+\.)*'. // 域名- www.
		'([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.'. // 二级域名
		'[a-z]{2,6})'.  // first level domain- .com or .museum
		'(:[0-9]{1,4})?'.  // 端口- :80
		'((\/\?)|'.  // a slash isn't required if there is no file name
		'(\/[0-9a-zA-Z_!~\'\(\)\[\]\.;\?:@&=\+\$,%#-\/^\*\|]*)?)$/',
		$s) == 1;
	}

$args=array(
	'orderby' => 'id',
	'order' => 'desc'
);
$categories=get_categories($args);//获取分类目录
$sora_hiddentheme_show_setting_data=get_option('sora_hiddentheme_show_setting_data');//为空返回'error'
$sora_hiddentheme_method_setting_data=get_option('sora_hiddentheme_method_setting_data');
$sora_hiddentheme_setting_data=get_option('sora_hiddentheme_setting_data');
$sora_hiddencssselsctor_img_setting_data=get_option('sora_hiddencssselsctor_img_setting_data');
$sora_hiddencssselsctor_viewcount_setting_data=get_option('sora_hiddencssselsctor_viewcount_setting_data');
$sora_hiddencssselsctor_downloadcount_setting_data=get_option('sora_hiddencssselsctor_downloadcount_setting_data');
$sora_hiddencssselsctor_fullsite_setting_data=get_option('sora_hiddencssselsctor_fullsite_setting_data');
$sora_hiddenimg_switch_setting_data=get_option('sora_hiddenimg_switch_setting_data');
$sora_hiddenimg_mode_setting_data=get_option('sora_hiddenimg_mode_setting_data');
$sora_hiddenimg_imgurl_setting_data=get_option('sora_hiddenimg_imgurl_setting_data');
$sora_hiddencategory=get_option('sora_hiddencategory');
$sora_hiddenviewcount_setting_data=get_option('sora_hiddenviewcount_setting_data');
$sora_hiddendownloadcount_setting_data=get_option('sora_hiddendownloadcount_setting_data');
$sora_use_s5button_setting_data=get_option('sora_use_s5button_setting_data');

function sora_hiddeninfo_writecookies(){
	global $categories;
	global $sora_hiddentheme_show_setting_data;
	global $sora_hiddentheme_method_setting_data;
	global $sora_hiddentheme_setting_data;
	global $sora_hiddencssselsctor_img_setting_data;
	global $sora_hiddencssselsctor_viewcount_setting_data;
	global $sora_hiddencssselsctor_downloadcount_setting_data;
	global $sora_hiddenimg_switch_setting_data;
	global $sora_hiddenimg_mode_setting_data;
	global $sora_hiddenimg_imgurl_setting_data;
	global $sora_hiddencategory;
	global $sora_hiddenviewcount_setting_data;
	global $sora_hiddendownloadcount_setting_data;
	global $sora_use_s5button_setting_data;
	$category_result='';
	foreach($categories as $category) {
		$category_name=$category->name;
		if(in_array($category_name,$sora_hiddencategory)) {
			$category_result.=$category_name.'&';
		}
	}
	setcookie('sora_hiddentheme_show_setting_data', $sora_hiddentheme_show_setting_data, time()+86400);//写入对谁可见
	setcookie('sora_hiddentheme_method_setting_data', $sora_hiddentheme_method_setting_data, time()+86400);//写入隐藏方法
	setcookie('sora_hiddentheme_setting_data', $sora_hiddentheme_setting_data, time()+86400);//写入主题选择
	setcookie('sora_hiddencssselsctor_img_setting_data', $sora_hiddencssselsctor_img_setting_data, time()+86400);//写入图片css
	setcookie('sora_hiddencssselsctor_viewcount_setting_data', $sora_hiddencssselsctor_viewcount_setting_data, time()+86400);//写入浏览数css
	setcookie('sora_hiddencssselsctor_downloadcount_setting_data', $sora_hiddencssselsctor_downloadcount_setting_data, time()+86400);//写入下载数css
	setcookie('sora_hiddenimg_switch_setting_data', $sora_hiddenimg_switch_setting_data, time()+86400);//写入图片隐藏开关
	setcookie('sora_hiddenimg_mode_setting_data', $sora_hiddenimg_mode_setting_data, time()+86400);//写入图片隐藏方式
	setcookie('sora_hiddenimg_imgurl_setting_data', $sora_hiddenimg_imgurl_setting_data, time()+86400);//写入占位图地址
	setcookie('category_result', urlencode($category_result), time()+86400);//写入要隐藏的分类目录名称
	setcookie('sora_hiddenviewcount_setting_data', $sora_hiddenviewcount_setting_data, time()+86400);//写入浏览数隐藏开关
	setcookie('sora_hiddendownloadcount_setting_data', $sora_hiddendownloadcount_setting_data, time()+86400);
	setcookie('sora_use_s5button_setting_data', $sora_use_s5button_setting_data, time()+86400);
}
add_action('after_setup_theme', 'sora_hiddeninfo_writecookies');
//add_action('admin_enqueue_scripts', 'sora_hiddeninfo_writecookies');

function sora_hiddeninfo_write_userinfo() {
	global $current_user;//获取用户名写入cookie
	$sora_hiddeninfo_user_nickname='';
	$sora_hiddeninfo_user_nickname=$current_user->nickname;//获取用户名
	if ($sora_hiddeninfo_user_nickname!='') {
		setcookie('sora_hiddeninfo_user_nickname', $sora_hiddeninfo_user_nickname, time()+86400);//获取用户名写入cookie
	} else {
		setcookie('sora_hiddeninfo_user_nickname', 'null', time()+86400);//清除cookie
	}
	if(in_array('administrator',$current_user->roles)) {
		setcookie('sora_hiddeninfo_user_permission', '1', time()+86400);//获取用户权限写入cookie
	} else {
		setcookie('sora_hiddeninfo_user_permission', '0', time()+86400);//清除用户权限写入cookie
	}
}
add_action('after_setup_theme', 'sora_hiddeninfo_write_userinfo');


function print_sora_hiddeninfo_style() {
	//wp_enqueue_style('font-awesome','http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.css',false,'4.4.0');
	wp_enqueue_style('sora-hiddeninfo-css',plugins_url('',__FILE__).'/css/sora-hiddeninfo.css',false,'0.2');
}
add_action('admin_enqueue_scripts','print_sora_hiddeninfo_style');

function print_sorahiddeninfo_admin_scripts($hook) {
	if($hook!='options-general.php') {
        return;
    }
	wp_enqueue_script('sora-hiddeninfo-admin-js',plugins_url('',__FILE__).'/js/sora-hiddenimg-admin.js');//加载
	wp_enqueue_script("jquery");
}
add_action('admin_enqueue_scripts','print_sorahiddeninfo_admin_scripts');

function print_sorahiddeninfo_scripts() {
	wp_enqueue_script('sora-hiddeninfo-js',plugins_url('',__FILE__).'/js/sora-hiddenimg.js');//加载
	wp_enqueue_script("jquery");
}
add_action('wp_enqueue_scripts','print_sorahiddeninfo_scripts');

//后台管理
function sora_hiddeninfo_add_option() {
	add_options_page('HiddenInfo', 'HiddenInfo', 'read', 'sora_hiddenInfo-option', 'sora_hiddeninfo_add_option_main');
}
add_action('admin_menu', 'sora_hiddeninfo_add_option',1);
function sora_hiddeninfo_add_option_main() {
	global $categories;
	global $sora_hiddentheme_show_setting_data;
	global $sora_hiddentheme_method_setting_data;
	global $sora_hiddentheme_setting_data;
	global $sora_hiddencssselsctor_img_setting_data;
	global $sora_hiddencssselsctor_viewcount_setting_data;
	global $sora_hiddencssselsctor_downloadcount_setting_data;
	global $sora_hiddenimg_switch_setting_data;
	global $sora_hiddenimg_mode_setting_data;
	global $sora_hiddenimg_imgurl_setting_data;
	global $sora_hiddencategory;
	global $sora_hiddenviewcount_setting_data;
	global $sora_hiddendownloadcount_setting_data;
	global $sora_use_s5button_setting_data;
	
	${$sora_hiddentheme_show_setting_data}='selected="selected"';
	${$sora_hiddentheme_method_setting_data}='selected="selected"';
	${$sora_hiddentheme_setting_data}='selected="selected"';
	${$sora_hiddencssselsctor_setting_data}='selected="selected"';
	${$sora_hiddenimg_switch_setting_data}='selected="selected"';
	${$sora_hiddenimg_mode_setting_data}='selected="selected"';
	${$sora_hiddenviewcount_setting_data}='selected="selected"';
	${$sora_hiddendownloadcount_setting_data}='selected="selected"';
	${$sora_use_s5button_setting_data}='selected="selected"';

	$category_result_show='';
	foreach($categories as $category) {
		$category_id=$category->term_id;
		$category_name=$category->name;
		$checked_sign=' ';
		if(in_array($category_name,$sora_hiddencategory)) {
			$checked_sign=' checked="checked"';
		}
		$category_result_show.='<li id="category-'.$category_id.'" style="width:33%;float:left;padding:0 2%;"><label class="selectit"><input value="'.$category_name.'" name="sora_hiddencategory[]" id="in-category-'.$category_id.'" type="checkbox"'.$checked_sign.'>'.$category_name.'</label></li>';
	}
	echo <<<EOF
	<form name="sora_hiddenimg_form" method="post" action="">
	<div class="sora-hiddeninfo-tab-body">
	<fieldset id="sora_hiddentheme_setting" class="sora-hiddeninfo-fieldset-start">
		<legend class="sora-hiddeninfo-button1">
			<span class="tx"><i class="fa fa-fw fa-wordpress"></i>主要设置</span>
		</legend>
		<table class="sora-hiddeninfo-form-table">
		<tbody>
			<tr>
				<th>
					<label for="sora_hiddentheme_show_setting_data">对谁可见</label>
				</th>
				<td>
					<select id="sora_hiddentheme_show_setting_data" class="widefat" name="sora_hiddentheme_show_setting_data">
						<option value="sora_hiddentheme_show_setting_selection1" $sora_hiddentheme_show_setting_selection1="">任何用户可见</option>
						<option value="sora_hiddentheme_show_setting_selection2" $sora_hiddentheme_show_setting_selection2="">登陆用户可见</option>
						<option value="sora_hiddentheme_show_setting_selection3" $sora_hiddentheme_show_setting_selection3="">仅管理员可见</option>
						<option value="sora_hiddentheme_show_setting_selection4" $sora_hiddentheme_show_setting_selection4="">任何用户隐藏</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_hiddentheme_method_setting_data">选择隐藏方法</label>
				</th>
				<td>
					<select id="sora_hiddentheme_method_setting_data" class="widefat" name="sora_hiddentheme_method_setting_data">
						<option value="sora_hiddentheme_method_setting_selection1" $sora_hiddentheme_method_setting_selection1="">使用内置规则</option>
						<option value="sora_hiddentheme_method_setting_selection2" $sora_hiddentheme_method_setting_selection2="">css选择器</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_hiddentheme_setting_data">选择内置规则</label>
				</th>
				<td>
					<select id="sora_hiddentheme_setting_data" class="widefat" name="sora_hiddentheme_setting_data">
						<option value="sora_hiddentheme_setting_selection1" $sora_hiddentheme_setting_selection1="">AO主题规则</option>
						<option value="sora_hiddentheme_setting_selection2" $sora_hiddentheme_setting_selection2="">S5主题规则</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_hiddencssselsctor_setting_data">css选择器设置<br>(多个用&隔开)</label>
				</th>
				<td>
					<input class="widefat" name="sora_hiddencssselsctor_img_setting_data" id="sora_hiddencssselsctor_img_setting_data" value="$sora_hiddencssselsctor_img_setting_data" placeholder="图片css选择器" type="text">
					<input class="widefat" name="sora_hiddencssselsctor_viewcount_setting_data" id="sora_hiddencssselsctor_viewcount_setting_data" value="$sora_hiddencssselsctor_viewcount_setting_data" placeholder="文章浏览数css选择器" type="text">
					<input class="widefat" name="sora_hiddencssselsctor_downloadcount_setting_data" id="sora_hiddencssselsctor_downloadcount_setting_data" value="$sora_hiddencssselsctor_downloadcount_setting_data" placeholder="附件下载css选择器" type="text">
					<input class="widefat" name="sora_hiddencssselsctor_fullsite_setting_data" id="sora_hiddencssselsctor_fullsite_setting_data" value="$sora_hiddencssselsctor_fullsite_setting_data" placeholder="全站隐藏css选择器" type="text">
				</td>
			</tr>
		</tbody>
		</table>
	</fieldset>
	<fieldset id="sora_hiddenimg_setting" class="sora-hiddeninfo-fieldset">
		<legend class="sora-hiddeninfo-button2">
			<span class="tx"><i class="fa fa-fw fa-eye-slash"></i> 图片隐藏设置 </span>
		</legend>
		<table class="sora-hiddeninfo-form-table">
		<tbody>
			<tr>
				<th>
					<label for="sora_hiddenimg_switch_setting_data">隐藏开关</label>
				</th>
				<td>
					<select id="sora_hiddenimg_switch_setting_data" class="widefat" name="sora_hiddenimg_switch_setting_data">
						<option value="sora_hiddenimg_switch_setting_selection1" $sora_hiddenimg_switch_setting_selection1="">不隐藏图片</option>
						<option value="sora_hiddenimg_switch_setting_selection2" $sora_hiddenimg_switch_setting_selection2="">隐藏首页图片</option>
						<option value="sora_hiddenimg_switch_setting_selection3" $sora_hiddenimg_switch_setting_selection3="">隐藏全站图片</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_hiddenimg_mode_setting_data">隐藏方式</label>
				</th>
				<td>
					<select id="sora_hiddenimg_mode_setting_data" class="widefat" name="sora_hiddenimg_mode_setting_data">
						<option value="sora_hiddenimg_mode_setting_selection1" $sora_hiddenimg_mode_setting_selection1="">图片模糊</option>
						<option value="sora_hiddenimg_mode_setting_selection2" $sora_hiddenimg_mode_setting_selection2="">占位图</option>
						<option value="sora_hiddenimg_mode_setting_selection3" $sora_hiddenimg_mode_setting_selection3="">隐藏分类(登陆恢复)</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_hiddenimg_imgurl_setting_data">占位图URL</label>
					<br>
					<a class="soran-hiddenimg-a" href="$sora_hiddenimg_imgurl_setting_data" target="_blank">
						<img class="sora-hiddenimg-img" src="$sora_hiddenimg_imgurl_setting_data">
					</a>
				</th>
				<td>
					<input class="widefat" name="sora_hiddenimg_imgurl_setting_data" id="sora_hiddenimg_imgurl_setting_data" value="$sora_hiddenimg_imgurl_setting_data" placeholder="隐藏图片的占位图 URL 地址" type="url">
				</td>
			</tr>
			<tr>
				<th>隐藏的分类</th>
				<td>
					<div class="categorydiv">
						<div class="tabs-panel">
							<ul class="categorychecklist"> 
								$category_result_show
							</ul>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
		</table>
	</fieldset>
	<fieldset id="sora_hiddenviewcount_setting" class="sora-hiddeninfo-fieldset-stop">
		<legend class="sora-hiddeninfo-button3">
			<span class="tx"><i class="fa fa-fw fa-eye-slash"></i>其他隐藏设置</span>
		</legend>
		<table class="sora-hiddeninfo-form-table">
		<tbody>
			<tr>
				<th>
					<label for="sora_hiddenviewcount_setting_data">文章浏览数隐藏开关</label>
				</th>
				<td>
					<select id="sora_hiddenviewcount_setting_data" class="widefat" name="sora_hiddenviewcount_setting_data">
						<option value="sora_hiddenviewcount_setting_selection1" $sora_hiddenviewcount_setting_selection1="">不隐藏文章浏览数</option>
						<option value="sora_hiddenviewcount_setting_selection2" $sora_hiddenviewcount_setting_selection2="">隐藏文章浏览数</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_hiddendownloadcount_setting_data">附件下载数隐藏开关</label>
				</th>
				<td>
					<select id="sora_hiddendownloadcount_setting_data" class="widefat" name="sora_hiddendownloadcount_setting_data">
						<option value="sora_hiddendownloadcount_setting_selection1" $sora_hiddendownloadcount_setting_selection1="">不隐藏附件下载数</option>
						<option value="sora_hiddendownloadcount_setting_selection2" $sora_hiddendownloadcount_setting_selection2="">隐藏附件下载数</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sora_use_s5button_setting_data">AO使用S5下载、点赞、收藏按钮样式</label>
				</th>
				<td>
					<select id="sora_use_s5button_setting_data" class="widefat" name="sora_use_s5button_setting_data">
						<option value="sora_use_s5button_setting_selection1" $sora_use_s5button_setting_selection1="">不开启</option>
						<option value="sora_use_s5button_setting_selection2" $sora_use_s5button_setting_selection2="">开启</option>
					</select>
				</td>
			</tr>
		</tbody>
		</table>
	</fieldset>
</div>
	<input name="submit" value="保存" class="sora-hiddeninfo-button4" type="submit">
	</form>
EOF;
	if($_POST['submit']=='保存') {
		update_option('sora_hiddentheme_show_setting_data',$_POST['sora_hiddentheme_show_setting_data']); //更新数据库
		update_option('sora_hiddentheme_method_setting_data',$_POST['sora_hiddentheme_method_setting_data']);
		update_option('sora_hiddentheme_setting_data',$_POST['sora_hiddentheme_setting_data']);
		update_option('sora_hiddencssselsctor_img_setting_data',$_POST['sora_hiddencssselsctor_img_setting_data']);
		update_option('sora_hiddencssselsctor_viewcount_setting_data',$_POST['sora_hiddencssselsctor_viewcount_setting_data']);
		update_option('sora_hiddencssselsctor_downloadcount_setting_data',$_POST['sora_hiddencssselsctor_downloadcount_setting_data']);
		update_option('sora_hiddencssselsctor_fullsite_setting_data',$_POST['sora_hiddencssselsctor_fullsite_setting_data']);
		update_option('sora_hiddenimg_switch_setting_data',$_POST['sora_hiddenimg_switch_setting_data']); 
		update_option('sora_hiddenimg_mode_setting_data',$_POST['sora_hiddenimg_mode_setting_data']); 
		if(is_url($_POST['sora_hiddenimg_imgurl_setting_data'])==true) {//检测是否是合法url
			update_option('sora_hiddenimg_imgurl_setting_data',$_POST['sora_hiddenimg_imgurl_setting_data']); 
		}
		update_option('sora_hiddencategory',$_POST['sora_hiddencategory']);
		update_option('sora_hiddenviewcount_setting_data',$_POST['sora_hiddenviewcount_setting_data']); 
		update_option('sora_hiddendownloadcount_setting_data',$_POST['sora_hiddendownloadcount_setting_data']); 
		update_option('sora_use_s5button_setting_data',$_POST['sora_use_s5button_setting_data']); 
		echo <<<EOF
		<script>
			alert('保存成功!');
			location.reload(true);
		</script>
EOF;
	}
}
?>