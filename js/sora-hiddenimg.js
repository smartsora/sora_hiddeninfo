//jQuery(document).ready(function($){
$(document).ready(function(){
	var sora_hiddentheme_show_setting_data='';
	var sora_hiddeninfo_user_nickname='';
	var sora_hiddeninfo_user_permission='';
	var sora_hiddentheme_method_setting_data='';
	var sora_hiddentheme_setting_data='';
	var sora_hiddencssselsctor_img_setting_data='';
	var sora_hiddencssselsctor_viewcount_setting_data='';
	var sora_hiddencssselsctor_downloadcount_setting_data='';
	var sora_hiddencssselsctor_fullsite_setting_data='';
	var sora_hiddenimg_switch_setting_data='';
	var sora_hiddenimg_mode_setting_data='';
	var sora_hiddenimg_imgurl_setting_data='';
	var category_result='';
	var sora_hiddenviewcount_setting_data='';
	var sora_hiddendownloadcount_setting_data='';
	var sora_use_s5button_setting_data='';
	
	sora_hiddentheme_show_setting_data=get_cookie('sora_hiddentheme_show_setting_data');
	sora_hiddeninfo_user_nickname=get_cookie('sora_hiddeninfo_user_nickname');
	sora_hiddeninfo_user_permission=get_cookie('sora_hiddeninfo_user_permission');
	sora_hiddentheme_method_setting_data=get_cookie('sora_hiddentheme_method_setting_data');
	sora_hiddentheme_setting_data=get_cookie('sora_hiddentheme_setting_data');
	sora_hiddencssselsctor_img_setting_data=get_cookie('sora_hiddencssselsctor_img_setting_data');
	sora_hiddencssselsctor_viewcount_setting_data=get_cookie('sora_hiddencssselsctor_viewcount_setting_data');
	sora_hiddencssselsctor_downloadcount_setting_data=get_cookie('sora_hiddencssselsctor_downloadcount_setting_data');
	sora_hiddencssselsctor_fullsite_setting_data=get_cookie('sora_hiddencssselsctor_fullsite_setting_data');
	sora_hiddenimg_switch_setting_data=get_cookie('sora_hiddenimg_switch_setting_data');
	sora_hiddenimg_mode_setting_data=get_cookie('sora_hiddenimg_mode_setting_data');
	sora_hiddenimg_imgurl_setting_data=get_cookie('sora_hiddenimg_imgurl_setting_data');
	category_result=decodeURI(get_cookie('category_result'));
	sora_hiddenviewcount_setting_data=get_cookie('sora_hiddenviewcount_setting_data');
	sora_hiddendownloadcount_setting_data=get_cookie('sora_hiddendownloadcount_setting_data');
	sora_use_s5button_setting_data=get_cookie('sora_use_s5button_setting_data');
	
	
	/*console.log(sora_hiddeninfo_user_nickname);
	console.log(sora_hiddentheme_method_setting_data);
	console.log(sora_hiddentheme_setting_data);
	console.log(sora_hiddencssselsctor_img_setting_data);
	console.log(sora_hiddencssselsctor_viewcount_setting_data);
	console.log(sora_hiddencssselsctor_downloadcount_setting_data);
	console.log(sora_hiddenimg_switch_setting_data);
	console.log(sora_hiddenimg_mode_setting_data);
	console.log(sora_hiddenimg_imgurl_setting_data);
	console.log(category_result);
	console.log(sora_hiddenviewcount_setting_data);
	console.log(sora_hiddendownloadcount_setting_data);*/
	
	
	
	
	if(sora_hiddenviewcount_setting_data=='sora_hiddenviewcount_setting_selection2') {//隐藏文章浏览数
		if(sora_hiddentheme_setting_data=='sora_hiddentheme_setting_selection1') {//使用AO内置规则
			$('div.inn-widget__posts-leaderboard__img-item__meta').remove();//隐藏小工具浏览数
			
		} else if(sora_hiddentheme_setting_data=='sora_hiddentheme_setting_selection2') {//使用S5内置规则
			$('div.metas.row').remove();//隐藏小工具浏览数
			$('span.entry-meta.post-views').remove();//隐藏文章浏览数
		}
	}
	if(sora_hiddendownloadcount_setting_data=='sora_hiddendownloadcount_setting_selection2') {//隐藏附件下载数
		if(sora_hiddentheme_setting_data=='sora_hiddentheme_setting_selection1') {//使用AO内置规则
			$(document).on('mouseenter',document,function(){//隐藏下载数
				$(this).find('span.inn-singular__post__toolbar__item__number').remove();
			})
			$(document).on('mousemove',document,function(){//隐藏下载数
				$(this).find('span.inn-singular__post__toolbar__item__number').remove();
			})
		} else if(sora_hiddentheme_setting_data=='sora_hiddentheme_setting_selection2') {//使用S5内置规则
			$(document).on('mouseenter',document,function(){//隐藏下载数
				$(this).find('b.number').remove();
			})
			$(document).on('mousemove',document,function(){//隐藏下载数
				$(this).find('b.number').remove();
			})
		}
		
	}
	if(sora_use_s5button_setting_data=='sora_use_s5button_setting_selection2') {//AO使用S5按钮
		var button_color = new Array();
		button_color[0]='#ff84f9';
		button_color[1]='#70a4ff';
		button_color[2]='#ff6c33';
		$(document).on('mouseenter',document,function(){//隐藏下载数
			var button_count=$('a.inn-singular__post__toolbar__item__link').length;
			if(button_count==1){
				var button_width=8;
				var button_div_left='calc(100% - 44rem)';
			}else if(button_count==2){
				var button_width=16;
				var button_div_left='calc(100% - 48rem)';
			}else if(button_count==3){
				var button_width=24;
				var button_div_left='calc(100% - 52rem)';
			}
			$(this).find('div#inn-singular__post__toolbar').css({'width':button_width+'rem','position':'relative','left':button_div_left});
			$(this).find('a.inn-singular__post__toolbar__item__link').css({'border-radius':'50%','margin':'0 0.5rem 0 0.5rem','height':'7rem','line-height':'5rem'});
			for(var i=0;i<button_count;i++){
				$(this).find('a.inn-singular__post__toolbar__item__link').eq(i).css('background',button_color[i]);
			}
			$(this).find('a.inn-singular__post__toolbar__item__link').removeAttr('padding');
			$(this).find('span.poi-icon.fa-thumbs-o-up.fas.fa-fw').remove();
			$(this).find('span.poi-icon.fa-cloud-download.fas.fa-fw').remove();
			$(this).find('span.poi-icon.fa-heart-o.fas.fa-fw').remove();
		})
		$(document).on('mousemove',document,function(){//隐藏下载数
			var button_count=$('a.inn-singular__post__toolbar__item__link').length;
			if(button_count==1){
				var button_width=8;
				var button_div_left='calc(100% - 44rem)';
			}else if(button_count==2){
				var button_width=16;
				var button_div_left='calc(100% - 48rem)';
			}else if(button_count==3){
				var button_width=24;
				var button_div_left='calc(100% - 52rem)';
			}
			$(this).find('div#inn-singular__post__toolbar').css({'width':button_width+'rem','position':'relative','left':button_div_left});
			$(this).find('a.inn-singular__post__toolbar__item__link').css({'border-radius':'50%','margin':'0 0.5rem 0 0.5rem','height':'7rem','line-height':'5rem'});
			for(var i=0;i<button_count;i++){
				$(this).find('a.inn-singular__post__toolbar__item__link').eq(i).css('background',button_color[i]);
			}
			$(this).find('a.inn-singular__post__toolbar__item__link').removeAttr('padding');
			$(this).find('span.poi-icon.fa-thumbs-o-up.fas.fa-fw').remove();
			$(this).find('span.poi-icon.fa-cloud-download.fas.fa-fw').remove();
			$(this).find('span.poi-icon.fa-heart-o.fas.fa-fw').remove();
		})
	}
	
	
	
	if(sora_hiddentheme_show_setting_data=='sora_hiddentheme_show_setting_selection1'){//对任何人可见，隐藏过程中断
		return false;
	}
	if(sora_hiddentheme_show_setting_data=='sora_hiddentheme_show_setting_selection3'&&sora_hiddeninfo_user_permission=='1'){//管理员可见，且是管理员
		return false;
	}
	if(sora_hiddentheme_show_setting_data=='sora_hiddentheme_show_setting_selection2'&&(sora_hiddeninfo_user_nickname!='' && sora_hiddeninfo_user_nickname!='null')) {//登陆用户可见，切已登陆
		return false;
	}
	if(sora_hiddenimg_switch_setting_data=='sora_hiddenimg_switch_setting_selection1') {//不隐藏图片，直接返回
		return false;
	} else if(sora_hiddenimg_switch_setting_data=='sora_hiddenimg_switch_setting_selection2') {//隐藏首页图片
		var category_result_arr=category_result.split('%26');//分割要隐藏的分类目录
		var category_result_arr_length=category_result_arr.length;
		if(sora_hiddentheme_method_setting_data=='sora_hiddentheme_method_setting_selection1') {//使用内置规则
			if(sora_hiddentheme_setting_data=='sora_hiddentheme_setting_selection1') {//使用AO内置规则
				var module_arr=$('span.inn-homebox__title__text');
				var module_arr_length=$('span.inn-homebox__title__text').length;
				module_arr.each(function() {
					for(i=0;i<category_result_arr_length;i++) {
						for(var j=0;j<module_arr_length;j++) {
							if(module_arr.eq(j).text()==category_result_arr[i]) {
								if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection1'){//图片模糊
									module_arr.eq(j).parent().parent().parent().parent().children('div.inn-homebox__body').css("filter","blur(9px)");//添加模块滤镜
								} else if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection2') {//占位图
									module_arr.eq(j).parent().parent().parent().parent().find('a.inn-homebox__item__thumbnail__container').append('<img src="'+sora_hiddenimg_imgurl_setting_data+'" style="position:absolute;width: 100%;height: 100%;left: 0;top: 0;">');
								} else if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection3') {//隐藏分类
									module_arr.eq(j).parent().parent().parent().parent().remove();
								}
							}
						}
					}
				})
			} else if(sora_hiddentheme_setting_data=='sora_hiddentheme_setting_selection2') {//使用S5内置规则
				var module_arr=$('span.title');
				var module_arr_length=$('span.title').length;
				module_arr.each(function() {
					for(i=0;i<category_result_arr_length;i++) {
						for(var j=0;j<module_arr_length;j++) {
							if(module_arr.eq(j).text()==category_result_arr[i]) {
								if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection1'){//图片模糊
									module_arr.eq(j).parent().parent().parent().parent().children('div.panel-body').css("filter","blur(9px)");//添加模块滤镜
								} else if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection2') {//占位图
									module_arr.eq(j).parent().parent().parent().parent().find('a.thumbnail-container').append('<img src="'+sora_hiddenimg_imgurl_setting_data+'" style="position:absolute;width: 100%;height: 100%;left: 0;top: 0;">');
								} else if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection3') {//隐藏分类
									module_arr.eq(j).parent().parent().parent().parent().remove();
								}
							}
						}
					}
				})
			} else {//无主题选择，返回
				return false;
			}
		} else if(sora_hiddentheme_method_setting_data=='sora_hiddentheme_method_setting_selection2') {//使用css选择器
			var sora_hiddencssselsctor_img_setting_data_arr=sora_hiddencssselsctor_img_setting_data.split('%26');//分割首页图片css
			var sora_hiddencssselsctor_img_setting_data_arr_length=sora_hiddencssselsctor_img_setting_data_arr.length;
			for(i=0;i<sora_hiddencssselsctor_img_setting_data_arr_length;i++) {
				var module_arr=$(sora_hiddencssselsctor_img_setting_data_arr[i]);
				var module_arr_length=$(sora_hiddencssselsctor_img_setting_data_arr[i]).length;
				module_arr.each(function() {
					for(i=0;i<category_result_arr_length;i++) {
						for(var j=0;j<module_arr_length;j++) {
							if(module_arr.eq(j).text()==category_result_result_arr[i]) {
								if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection1'){//图片模糊
									module_arr.eq(j).parent().parent().parent().parent().parent().children('div.panel-body').css("filter","blur(9px)");//添加模块滤镜
								} else if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection2') {//占位图
									module_arr.eq(j).parent().parent().parent().parent().parent().find('div.thumbnail-container').append('<img src="'+sora_hiddenimg_imgurl_setting_data+'" style="position:absolute;width: 100%;height: 100%;left: 0;top: 0;">');
								} else if(sora_hiddenimg_mode_setting_data=='sora_hiddenimg_mode_setting_selection3') {//隐藏分类
									module_arr.eq(j).parent().parent().parent().parent().parent().remove();
								}
							}
						}
					}
				})
			}
		} else{//无规则选择，返回
			return false;
		}
	} else if(sora_hiddenimg_switch_setting_data=='sora_hiddenimg_switch_setting_selection3') {//隐藏全站图片
		
	} else{//无隐藏开关，直接返回
		return false;
	}
})
function killErrors() { 
 return true; 
} 
//window.onerror = killErrors;

function get_cookie(c_name) {//获取cookies
	var c_start='';
	var c_end='';
	if (document.cookie.length>0) {
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1) { 
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) {
				c_end=document.cookie.length;
			}
		return decodeURIComponent(document.cookie.substring(c_start,c_end));
		} 
	}
	return "null";
}