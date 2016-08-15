<?php

require_once __DIR__ . '/common.inc.php';

use smtech\CanvasHack\Plugin\GlobalNavigationMenu\MenuItem;
use smtech\CanvasHack\Plugin\GlobalNavigationMenu\Menu;

/*
 * TODO is it worth trying to cache this?
 */
$response = $customPrefs->query("
    SELECT *
        FROM `users`
        WHERE
            `id` = '" . $_REQUEST['current_user']['id'] . "'
");
$user = $response->fetch_assoc();
$query = "
    SELECT m.*, acl.`group`, g.`user`
        FROM `menu-items` AS m
            LEFT JOIN `menu-acl` AS acl
                ON acl.`menu-item` = m.`id`
            LEFT JOIN `group-memberships` AS g
                ON g.`group` = acl.`group`
        WHERE
            (
                " . (empty($user['role']) ? '' : "`role` = '{$user['role']}' OR ") . "
                `role` IS NULL
            ) AND
            (
                acl.`group` IS NULL OR
                (
                    acl.`group` IS NOT NULL AND
                    g.`user` = '{$user['id']}'
                )
            )
        ORDER BY
            `parent` ASC,
            `order` ASC
";
$response = $customPrefs->query($query);

$menus = [];
while ($item = $response->fetch_assoc()) {
    if (empty($item['parent'])) {
        $menus[$item['id']] = new Menu(
            $item,
            $pluginMetadata['PLUGIN_URL'],
            $user['id'],
            $_REQUEST['location']
        );
    } else {
        $menus[$item['parent']]->items[] = new MenuItem(
            $item,
            $pluginMetadata['PLUGIN_URL'],
            $user['id'],
            $_REQUEST['location']
        );
    }
}
$trays = [];
foreach ($menus as $id => $menu) {
    $trays["tray$id"] = "tray$id: '" . preg_replace('/(\n|\r|\t)/', ' ', $menu) . "'";
}
