var canvashack = {
	loadMenus: function() {
		$('body').append('<script src="@PLUGIN_PATH/navigation-menu.php?user_id=' + $('#identity .user_id').html() + '"></script>')
	}
}