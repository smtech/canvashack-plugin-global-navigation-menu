<?php

namespace smtech\CanvasHack\Plugin\GlobalNavigationMenu;

class MenuItem
{
    protected $baseUrl;
    protected $userId;
    protected $location;

    public function __construct($row, $baseUrl, $userId, $location)
    {
        $this->baseUrl = $baseUrl;
        $this->userId = $userId;
        $this->location = $location;
        foreach ($row as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __toString()
    {
        return     '<li class="ReactTray-list-item" style="' . $this->css . '">
                    <a href="' . $this->baseUrl . '/click.php?item=' . $this->id . '&user_id=' . $this->userId . '&location=' . $this->location . '" target="' . $this->target . '" class="ReactTray-list-item__link">' . $this->title . '</a>
                    <div class="ReactTray-list-item__helper-text" >' . $this->subtitle . '</div>
                </li>';
    }
}
