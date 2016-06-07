<?php

require_once __DIR__ . '/common.inc.php';

if (!empty($_REQUEST['location']) && preg_match('%^https://stmarksschool\.beta\.instructure\.com%', $_REQUEST['location'])) {
	require_once 'new-ui.js.php';
	exit;
}

?>
var canvashack = {
	loadMenus: function() {
		"use strict";
		$('body').append('<script src="<?= $pluginMetadata['PLUGIN_URL'] ?>/navigation-menu.js.php?user_id=' + $('#identity .user_id').html() + '"></script>');
	}
};
