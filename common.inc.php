<?php

require_once(__DIR__ . '/../common.inc.php');

if (file_exists('manifest.xml')) {
	$manifest = simplexml_load_string(file_get_contents('manifest.xml'));
}

$pluginMetadata = new Battis\AppMetadata($sql, (string) $manifest->id);

// $customPrefs = mysqli_connect( DON'T EVER COMMIT YOUR CREDENTIALS! );

$cache = new Battis\HierarchicalSimpleCache($sql, basename(__DIR__));

?>