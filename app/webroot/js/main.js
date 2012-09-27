// JavaScript Document
$(document).ready(function(){
	$('.thumb_list_block .main .items_group li.more a').hover(function(){
		$(this).find('span.more_icon').toggleClass('more_icon_hover');
	});
	
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
