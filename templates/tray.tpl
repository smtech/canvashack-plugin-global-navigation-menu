<div class="ReactTrayPortal">
    <div class="ReactTray__Overlay ReactTray__Overlay--after-open canvashack_global-navigation-menu" style="position: fixed; top: 0px; left: 0px; right: 0px; bottom: 0px;">
        <div style="position:absolute;background:#fff;" class="ReactTray__Content ReactTray__Content--after-open" tabindex="-1">
            <div class="ic-NavMenu__layout">
                <div class="ic-NavMenu__primary-content">
                    <div class="ic-NavMenu__header">
                        <h1 class="ic-NavMenu__headline">{$title}</h1>
                        <button class="Button Button--icon-action ic-NavMenu__closeButton" type="button">
                            <i class="icon-x"></i>
                            <span class="screenreader-only">Close</span>
                        </button>
                    </div>
                    <ul class="ic-NavMenu__link-list">
                        {foreach $items as $item}
                            {include file="item.tpl"}
                        {/foreach}
                    </ul>
                </div>
                <div class="ic-NavMenu__secondary-content">
                    {$info}
                </div>
            </div>
        </div>
    </div>
</div>
