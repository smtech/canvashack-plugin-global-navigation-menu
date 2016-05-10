<?php

require_once __DIR__ . '/common.inc.php';

?>
var canvashack = {
	loadMenus: function() {
		$('body').append('<script src="<?= $pluginMetadata['PLUGIN_URL'] ?>/navigation-menu.js.php?user_id=' + $('#identity .user_id').html() + '"></script>');
	}
};
