<?php


header('Content-Type: application/javascript');

require_once('common.inc.php');

$cache->pushKey(basename(__FILE__, '.php'));
$cache->pushKey($_REQUEST['current_user']['id']);
$cache->pushKey($_REQUEST['location']);
$html = $cache->getCache('html');
if (empty($html)) {
	$response = $customPrefs->query("
		SELECT *
			FROM `users`
			WHERE
				`id` = '" . $_REQUEST['current_user']['id'] . "'
	");
	$user = $response->fetch_assoc();
	
	$query = "
		SELECT m.`id`, m.`parent`, m.`order`, m.`title`, m.`subtitle`, m.`info`, m.`url`, m.`target`, m.`role`, acl.`group`, g.`user`
			FROM `menu-items` AS m
				LEFT JOIN `menu-acl` AS acl
					ON acl.`menu-item` = m.`id`
				LEFT JOIN `group-memberships` AS g
					ON g.`group` = acl.`group`
			WHERE
				m.`parent` IS NULL OR (
					m.`column` IS NOT NULL AND
					m.`section` IS NOT NULL
				) AND
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
}

class MenuItem {
	public function __construct($row) {
		foreach ($row as $key => $value) {
			$this->$key = $value;
		}
	}
	
	public function __toString() {
		return 	'<li class="ReactTray-list-item" >
					<a href="' . $this->url . '" target="' . $this->target . '" class="ReactTray-list-item__link">' . $this->title . '</a>
					<div class="ReactTray-list-item__helper-text" >' . $this->subtitle . '</div>
				</li>';

	}
}

class Menu extends MenuItem {
	public $items = [];
	
	public function __toString() {
		return '<div id="canvashack_global-navigation-menu" style="position:absolute;background:#fff;" class="ReactTray__Content ReactTray__Content--after-open " tabindex="-1" >
					<div class="ReactTray__layout" >
						<div class="ReactTray__primary-content" >
							<div class="ReactTray__header" >
								<h1 class="ReactTray__headline" >' . $this->title . '</h1>
								<button id="canvashack_tray_close" class="Button Button--icon-action ReactTray__closeBtn" type="button" >
									<i class="icon-x" ></i>
									<span class="screenreader-only" >Close</span>
								</button>
							</div>
							<ul class="ReactTray__link-list" >' .
								implode(PHP_EOL, $this->items) . PHP_EOL . 
								'<!--<li class="ReactTray-list-item ReactTray-list-item--feature-item" >
									<a href="@@Featured Item URL@@" >@@Featured Item@@</a>
								</li>-->
							</ul>
						</div>
						<div class="ReactTray__secondary-content" >
							<div class="ReactTray__info-box" >
								' . $this->info . '
							</div>
						</div>
					</div>
				</div>';

	}
}

$menus = [];
while ($item = $response->fetch_assoc()) {
	if (empty($item['parent'])) {
		$menus[$item['id']] = new Menu($item);
	} else {
		$menus[$item['parent']]->items[] = new MenuItem($item);
	}
}

$trays = [];
foreach ($menus as $id => $menu) {
	$trays["tray$id"] = "tray$id: '" . preg_replace('/(\n|\t)/', ' ', $menu) . "'";
}

?>
var canvashack = {
	trays: {
		<?= implode (',' . PHP_EOL, $trays) ?>
	},
	
	showMyTray: function(id) {
		"use strict";
		var self = this;
		
		/* show tray */
		$('.ReactTrayPortal > div').addClass('ReactTray__Overlay ReactTray__Overlay--after-open').css('position', 'fixed').css('top', '0px').css('left', '0px').css('right', '0px').css('bottom', '0px').append(this.trays[id]);
		
		/* change menu item highlight */
		var previousSelection = $('.ic-app-header__menu-list-item--active').removeClass('ic-app-header__menu-list-item--active');
		$('#' + id).addClass('ic-app-header__menu-list-item--active');
		$('#canvashack_tray_close').on('click', function () {
			self.hideMyTray(id, previousSelection);
		});
		
		/* allow other menu items to open over this tray */
		$('#menu li:not(.canvashack.global-navigation-menu)').on('click', function () {
			self.hideMyTray(id);
		});
		
		$('#' + id).off('click.canvashack.global-navigation-menu').on('click.canvashack.global-navigation-menu', function () {
			self.hideMyTray(id, previousSelection);
		});
	},
	
	hideMyTray: function(id, previousSelection) {
		"use strict";
		var self = this;
		
		/* hide my tray */
		$('#canvashack_global-navigation-menu').remove();
		$('#' + id).off('click.canvashack.global-navigation-menu').on('click.canvashack.global-navigation-menu', function() {
			self.showMyTray(id);
		});
		
		/* change menu item highlight back, etc. if just closing my tray */
		if (previousSelection != undefined) {
			$('.ic-app-header__menu-list-item--active').removeClass('ic-app-header__menu-list-item--active');
			$('.ReactTray__Overlay').css('position', '').css('top', '').css('left', '').css('right', '').css('bottom', '');
			$('.ReactTray__Overlay').removeClass('ReactTray__Overlay--after-open');
			previousSelection.addClass('ic-app-header__menu-list-item--active');
		}
	},
	
	addMenuItem: function (title, url, id, before, after) {
		"use strict";
		var self = this;
		
		/* build menu item */
		var menuItem =
			'<li id="' + id + '" class="ic-app-header__menu-list-item canvashack_global-navigation-menu">' +
				'<a href="' + url + '" class="ic-app-header__menu-list-link">' +
					'<div class="menu-item-icon-container" aria-hidden="true">' +
		            '</div>' +
		            '<div class="menu-item__text">' + title + '</div>' +
		        '</a>' +
		    '</li>';
		    
		/* figure out where to put the menu item */
		if(before != undefined) {
			$('#menu li:has(a#' + before + ')').before(menuItem);
		} else if (after !== undefined) {
			$('#menu li:has(a#' + after + ')').after(menuItem);
		} else {
			$('#menu').append(menuItem);
		}
		    
		    
		$('#' + id).on('click.canvashack.global-navigation-menu', function() {
			self.showMyTray(id);
		});
	},
	
	loadMenus: function() {
		"use strict";
		<?php
			foreach ($menus as $id => $menu) {
				echo "this.addMenuItem('{$menu->title}','{$menu->url}', 'tray{$id}', null, 'global_nav_profile_link');" . PHP_EOL;
			}
		?>
	}
};