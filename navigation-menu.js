<?php

/*
 * Nota bene: this file _will_ be run through the PHP preprocessor no matter
 * what its file extension is (CanvasHack is stubborn that way!)
 */
require_once 'navigation-menu.php';

if (empty($_REQUEST['current_user'])) {
    echo "var canvashack = {
    loadMenus: function () {
        /* no user, no menu -- them's the breaks! */
    }
};
    ";
    exit;
}

?>
var canvashack = {
  trays: {
    <?= implode(',' . PHP_EOL, $trays) ?>
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

  addMenuItem: function (title, url, svg, id, before, after) {
    "use strict";
    var self = this;

    /* build menu item */
    var menuItem =
      '<li id="' + id + '" class="ic-app-header__menu-list-item canvashack_global-navigation-menu">' +
        '<a href="' + url + '" class="ic-app-header__menu-list-link">' +
          '<div class="menu-item-icon-container" aria-hidden="true">' +
            svg +
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

    $('#' + id + '.canvashack_global-navigation-menu svg').attr('class', 'ic-icon-svg ic-icon-svg--dashboard');
    $('#' + id).on('click.canvashack.global-navigation-menu', function() {
      self.showMyTray(id);
    });
  },

  loadMenus: function() {
    "use strict";
    <?php
      foreach ($menus as $id => $menu) {
        echo "this.addMenuItem('{$menu->title}','{$menu->url}', '" . preg_replace('%(\n|\r|\t)%', ' ', $menu->svg) . "', 'tray{$id}');" . PHP_EOL;
      }
    ?>
  }
};
