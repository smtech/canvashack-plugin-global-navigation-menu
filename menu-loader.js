var canvashack = {
	loadMenus: function() {
		$('body').append('<script src="' + $("script[src$='canvashack.js']").attr('src').replace('canvashack.js', 'hacks/global-navigation-menu/navigation-menu.js.php?user_id=' + $('#identity .user_id').html()) + '"></script>');
	}
};