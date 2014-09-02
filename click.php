<?php

require_once(__DIR__ . '/config.inc.php');
require_once(SMCANVASLIB_PATH . '/include/mysql.inc.php');

if(isset($_REQUEST['item'])) {
	// FIXME should really enforce roles/groups restrictions (although they are really only cosmetic)
	$response = mysqlQuery("
		SELECT *
			FROM `menu-items`
			WHERE
				`id` = '{$_REQUEST['item']}'
	");
	$item = $response->fetch_assoc();
	$canvasInstance = parse_url($_REQUEST['location'], PHP_URL_HOST);
	$location = ($item['url'][0] == '/' ? "https://{$canvasInstance}{$item['url']}" : $item['url']);
	mysqlQuery("
		INSERT
			INTO `menu-clicks`
			(
				`user`,
				`source`,
				`destination`
			) VALUES (
				'{$_REQUEST['user_id']}',
				'{$_REQUEST['location']}',
				'{$location}'
			)
	");
	header("Location: {$location}");
	exit;
}

?>