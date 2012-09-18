// JavaScript Document
$(document).ready(function(){
	$('.thumb_list_block .main .items_group li.more a').hover(function(){
		$(this).find('span.more_icon').toggleClass('more_icon_hover');
	});
});