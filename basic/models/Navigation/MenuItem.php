<?php

namespace app\models\Navigation;


class MenuItem {

    private $label;
    private $url;
    private $active;
    private $items = [];


    /**
     * label: string, required, the nav item label.
     * url: optional, the item's URL. Defaults to "#".
     * visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * linkOptions: array, optional, the HTML attributes of the item's link.
     * options: array, optional, the HTML attributes of the item container (LI).
     * active: boolean, optional, whether the item should be on active state or not.
     * items: array|string, optional, the configuration array for creating a yii\bootstrap\Dropdown widget,
     * or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     */

    //public function __construct($label, $url, $visible, $linkOptions, $options, $active, $items)
    public function __construct($label, $url, $active, $items)
    {
        $this->label = $label;
        $this->url = $url;
        $this->active = $active;
        $this->items = $items;
    }

}
