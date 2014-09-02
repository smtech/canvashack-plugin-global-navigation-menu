<?php

header('Content-Type: application/javascript');

require_once(__DIR__ . '/config.inc.php');
require_once(SMCANVASLIB_PATH . '/include/mysql.inc.php');
require_once(SMCANVASLIB_PATH . '/include/cache.inc.php');

if (isset($_REQUEST['user_id'])) {
	if (is_numeric($_REQUEST['user_id'])) {
		$userId = $_REQUEST['user_id'];
	} else {
		$userId = preg_replace('|.*users/(\d+)/?.*|', '$1', $_REQUEST['user_id']);
	}
}

if (!isset($userId) || !strlen($userId)) {
	exit;
}

/* get the current user's preferences */
$response = mysqlQuery("
	SELECT * FROM `users`
		WHERE
			`id` = '" . $userId . "'
");
$userPrefs = $response->fetch_assoc();
$userPrefs['groups'] = unserialize($userPrefs['groups']);

/* build our list of courses that should be removed from the Courses menu */
$response = mysqlQuery("
	SELECT * FROM `courses`
		WHERE
			`menu-visible` = '0'
");
while ($c = $response->fetch_assoc()) {
	$coursesToHide[] = $c['id'];
}

function isMenu($menuItem) {
	return !is_numeric($menuItem['menu']);
}

function isColumn($menuItem) {
	return !is_numeric($menuItem['column']) && !isMenu($menuItem);
}

function isSection($menuItem) {
	return !is_numeric($menuItem['section']) && !isColumn($menuItem);
}

function isItem($menuItem) {
	return is_numeric($menuItem['section']);
}

function nonempty($flag, $value) {
	return (strlen($flag) ? $value : '');
}

function startMenu($menuItem) {
	return '<a class="menu-item-title"' .
		nonempty(
			$menuItem['url'],
			' href="' . $menuItem['url'] . '"'
		) . nonempty(
			$menuItem['target'],
			' target="' . $menuItem['target'] . '"'
		) . '>' . $menuItem['title'] . '<span class="menu-item-title-icon"/> <i class="icon-mini-arrow-down"/></a><div class="menu-item-drop"><table cellspacing="0"><tr>';
}

function endMenu() {
	return '</tr></table></div>';
}

function startColumn($menuItem) {
	return '<td class="menu-item-drop-column"' .
		nonempty(
			$menuItem['style'],
			' style="' . $menuItem['style'] . '"'
		) . '>';
}

function endColumn() {
	return '</td>';
}

function startSection($menuItem) {
	return nonempty(
		$menuItem['title'],
		'<span class="menu-item-heading"' .
			nonempty(
				$menuItem['style'],
				' style="' . $menuItem['style'] . '"'
			) . '>' . $menuItem['title'] . '</span>'
		) . '<ul class="menu-item-drop-column-list"' . 
		nonempty(
			$menuItem['style'],
			' style="' . $menuItem['style'] . '"'
		) . '>';
}

function endSection() {
	return '</ul>';
}

function menuItem($menuItem) {
	global $userPrefs;
	return '<li' .
		nonempty(
			$menuItem['style'],
			' style="' . $menuItem['style'] . '"'
		) . '><a' . 
		nonempty(
			$menuItem['target'],
			' target="' . $menuItem['target'] . '"'
		) . nonempty(
			$menuItem['url'],
			' href="' . /*$menuItem['url']*/ APP_URL . "/click.php?item={$menuItem['id']}&user_id={$userPrefs['id']}&location=@@LOCATION@@" . '"'
		) . '><span class="name ellipsis">' . $menuItem['title'] . '</span>' .
		nonempty(
			$menuItem['subtitle'],
			'<span class="subtitle">' . $menuItem['subtitle'] . '</span>'
		) . '</a></li>';
}

$menuHtml = getCache('user', $userPrefs['id'], 'menus');
if (!$menuHtml) {
	/* build a set of regexp conditions to find this user's groups in serialized group lists hanging off of menu items */
	$userGroups = 'FALSE';
	if (is_array($userPrefs['groups'])) {
		$userGroups == '';
		foreach($userPrefs['groups'] as $g) {
			$userGroups = (strlen($userGroups) ? " {$userGroups} OR " : '') . "`groups` REGEXP 'a:[0-9]+\{(i:[0-9]+;i:[0-9]+;)*i:[0-9]+;i:{$g};(i:[0-9]+;i:[0-9]+;)*\}'";
		}
	}
	
	/* build the menus */
	// TODO no doubt this could be elegantly wrapped up in a recursive function full of menu-related puns
	$menuHtml = array();
	$menus = mysqlQuery("
		SELECT *
			FROM `menu-items`
			WHERE
				`menu` IS NULL AND
				(
					`role` IS NULL OR
					`role` = '" . $userPrefs['role'] . "'
				) AND (
					`groups` IS NULL OR
					" . $userGroups . "
				)
			ORDER BY
				`order` ASC,
				`title` ASC
	");
	for ($i = 0; $m = $menus->fetch_assoc(); $i++) {
		$menuHtml[$i] = startMenu($m);
		$columns = mysqlQuery("
			SELECT *
				FROM `menu-items`
				WHERE
					`menu` = '" . $m['id'] . "' AND
					`column` IS NULL AND
					(
						`role` IS NULL OR
						`role` = '" . $userPrefs['role'] . "'
					) AND (
						`groups` IS NULL OR
						" . $userGroups . "
					)
				ORDER BY
					`order` ASC,
					`title` ASC
		");
		while ($c = $columns->fetch_assoc()) {
			$menuHtml[$i] .= startColumn($c);
			$sections = mysqlQuery("
				SELECT *
					FROM `menu-items`
					WHERE
						`menu` = '" . $m['id'] . "' AND
						`column` = '" . $c['id'] . "' AND
						`section` IS NULL AND
						(
							`role` IS NULL OR
							`role` = '" . $userPrefs['role'] . "'
						) AND (
							`groups` IS NULL OR
							" . $userGroups . "
						)
					ORDER BY
						`order` ASC,
						`title` ASC
			");
			while ($s = $sections->fetch_assoc()) {
				$menuHtml[$i] .= startSection($s);
				$items = mysqlQuery("
					SELECT *
						FROM `menu-items`
						WHERE
							`menu` = '" . $m['id'] . "' AND
							`column` = '" . $c['id'] . "' AND
							`section` = '" . $s['id'] . "' AND
							(
								`role` IS NULL OR
								`role` = '" . $userPrefs['role'] . "'
							) AND (
								`groups` IS NULL OR
								" . $userGroups . "
							)
						ORDER BY
							`order` ASC,
							`title` ASC
				");
				while ($item = $items->fetch_assoc()) {
					$menuHtml[$i] .= menuItem($item);
				}
				$menuHtml[$i] .= endSection();
			}
			$menuItem[$i] .= endColumn();
		}
		$menuHtml[$i] .= endMenu();
	}
	setCache('user', $userPrefs['id'], 'menus', $menuHtml);
}

$menuHtml = str_replace('@@LOCATION@@', $_REQUEST['location'], $menuHtml);

?>
/*jslint browser: true, devel: true, eqeq: true, plusplus: true, sloppy: true, todo: true, vars: true, white: true */

// types of user
// TODO pull this from DB too
var USER_CLASS_STUDENT = 'student';
var USER_CLASS_STAFF = 'staff';
var USER_CLASS_FACULTY = 'faculty';
var USER_CLASS_NO_MENU = 'no-menu';

// the class of the current user
var userClass = <?= (strlen($userPrefs['role']) ? "'{$userPrefs['role']}'" : 'USER_CLASS_NO_MENU') ?>;

// courses that (if they exist in Courses) are replicated in the Resources menu
var coursesToHide = [<?php foreach($coursesToHide as $c) {if($c != $coursesToHide[0]) echo ','; echo "{$c}";} ?>];

// remove courses from the Courses menu that have been replicated in custom menus
function stmarks_hideCourses(courses) {
	var i;
	var coursesList = document.getElementById('menu_enrollments').children[2].children;
	for (i = 1; i < coursesList.length; i += 1) {
		if (courses.indexOf(coursesList[i].getAttribute('data-id')) > -1) {
			coursesList[i].parentNode.removeChild(coursesList[i]);
			i = 0; // start at the beginning again... eventually we'll hide them all and escape!
		}
	}
}

// parse the array/object structure above into the HTML that represents a dropdown menu and add it to the right of the existing menubar
function stmarks_appendMenu(html) {
	var navigationMenu = document.getElementById("menu");
	var menu = document.createElement('li');
	menu.setAttribute('class', 'menu-item');
	menu.innerHTML = html;
	navigationMenu.appendChild(menu);
}

function stmarks_navigationMenu() {
	// add the custom menu to the menubar
	// if you wanted to add more menus, define another menu structure like resources and call appendMenu() with it as a parameter (menus would be added in the order that the appendMenu() calls occur)
	if (userClass != USER_CLASS_NO_MENU) {
		// append menus
<?php
		foreach ($menuHtml as $m) {
			echo "\t\tstmarks_appendMenu('{$m}');\n";
		} ?>
		
		// hide courses last, since some userClass identification is based on course enrollments!
		stmarks_hideCourses(coursesToHide);
	}
}

