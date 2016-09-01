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
}
