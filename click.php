<?php

require_once 'common.inc.php';

if (isset($_REQUEST['item'])) {
    // FIXME should really enforce roles/groups restrictions (although they are really only cosmetic)
    $response = $customPrefs->query("
        SELECT *
            FROM `menu-items`
            WHERE
                `id` = '{$_REQUEST['item']}'
    ");
    $item = $response->fetch_assoc();
    $canvasInstance = parse_url($_REQUEST['location'], PHP_URL_HOST);
    $location = ($item['url'][0] == '/' ? "{$_SESSION['canvasInstanceUrl']}{$item['url']}" : $item['url']);
    $customPrefs->query("
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
