<?php

require_once(__DIR__ . '/config.inc.php');
require_once(SMCANVASLIB_PATH . '/include/mysql.inc.php');

if(isset($_REQUEST['item'])) {
	// FIXME should really enforce roles/groups restrictions (although they are really only cosmetic)
	$response = mysqlQuery("
		SELECT *
			FROM `menus`
			WHERE
				`id` = '{$_REQUEST['item']}'
	");
	$item = $response->fetch_assoc();
	$location = ($item['url'][0] == '/' ? "https://{$_REQUEST['canvas_instance']}{$item['url']}" : $item['url']);
	header("Location: {$location}");
	exit;
}

?>