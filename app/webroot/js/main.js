// JavaScript Document
$(document).ready(function(){
	$('.thumb_list_block .main .items_group li.more a').hover(function(){
		$(this).find('span.more_icon').toggleClass('more_icon_hover');
	});
	
	var urlArgs = getQueryStringArgs();
	var about_index = urlArgs['about_index'];
	//alert(urlArgs['about_index'])
	if( about_index != null){
		$('.about_menu li a').parent().siblings().find('a').removeClass('current').end().end().end().eq(about_index).addClass('current');
		$('.about_detail').hide().eq(about_index).fadeIn(500);
	}
	
	$('.about_menu li a').click(function(event){
		event.preventDefault();
		//alert('done');
		if(!$(this).hasClass('current')){
			var x = $(this).parent().siblings().andSelf().index($(this).parent());
			//alert(x);
			$(this).parent().siblings().find('a').removeClass('current').end().end().end().addClass('current');
			$('.about_detail').hide().eq(x).fadeIn(500);
		}
	});
	
});
