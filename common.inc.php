<?php

require_once(__DIR__ . '/../common.inc.php');

if (file_exists(__DIR__ . '/manifest.xml')) {
	$manifest = simplexml_load_string(file_get_contents(__DIR__ . '/manifest.xml'));
}

$pluginMetadata = new Battis\AppMetadata($sql, (string) $manifest->id);

// FIXME le sigh… a more elegant password management scheme is needed here (save to config database, etc.)
$customPrefs = mysqli_connect($secrets->mysql->customprefs->host, $secrets->mysql->customprefs->username, $secrets->mysql->customprefs->password, $secrets->mysql->customprefs->database);

$cache = new Battis\HierarchicalSimpleCache($sql, basename(__DIR__));

?>
