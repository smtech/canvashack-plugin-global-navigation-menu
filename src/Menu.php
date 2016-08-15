<?php

namespace smtech\CanvasHack\Plugin\GlobalNavigationMenu;

class Menu extends MenuItem
{
    public $items = [];

    public function __toString()
    {
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
