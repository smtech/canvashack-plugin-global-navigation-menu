<?php

require_once 'common.inc.php';

?>
var canvashack = {
	loadMenus: function() {
		$('body').append('<script src="<?= $pluginMetadata['PLUGIN_URL'] ?>/global-navigation-menu/navigation-menu.js.php?user_id=' + $('#identity .user_id').html()) + '"></script>');
	}
};
