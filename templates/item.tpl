<li class="ic-NavMenu-list-item" {if !empty($item->css)}style="{$item->css}"{/if}>
    <a href="{$menu->baseUrl}/click.php?{http_build_query([
        'item' => $item->id,
        'user_id' => $menu->userId,
        'location' => $menu->location
        ])}" target="{$item->target}" class="ic-NavMenu-list-item__link">{$item->title}</a>
    {if !empty($item->subtitle)}<div class="ic-NavMenu-list-item__helper-text">{$item->subtitle}</div>{/if}
</li>
