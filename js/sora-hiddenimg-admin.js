jQuery(document).ready(function($) {
	$('input[type="checkbox"]').click(function() {
		if($(this).prop('checked')) {
			$(this).attr('checked','true');
			$(this).attr('name','sora_hiddencategory[]');
		} else {
			$(this).removeAttr('checked');
			$(this).removeAttr('name');
		}
	})
	$('input#sora_hiddenimg_imgurl_setting_data').blur(function() {
		var sora_hiddenimg_imgurl_setting_data=$(this).val();
		var url=/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
		if(url.test(sora_hiddenimg_imgurl_setting_data)) {//正则判断是否为url
			$('img.sora-hiddenimg-img').attr('src',sora_hiddenimg_imgurl_setting_data);
			$('a.soran-hiddenimg-a').attr('href','sora_hiddenimg_imgurl_setting_data');
		}	
	})
})