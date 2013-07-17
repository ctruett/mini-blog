jQuery(document).ready(function() {
	 $('p').widont();

	 w = $('body').width();

	 $('blockquote').each(function(){
			var bw = $(this).width();
			var p = Math.floor((w - bw)) / 2;
			$(this).css({
				 'padding-left':p,
				 'padding-right':p
			});
	 });
});
