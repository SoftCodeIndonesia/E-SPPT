<?php

class Helper extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = $this->model('M_menu');
    }

    public function redrect($url)
    {
        header('location: ' . $url);
    }

    public function form_error($field)
    {
        if (!empty($_SESSION['form_error'][$field])) {
            echo $_SESSION['form_error'][$field];
        }
    }

    public function set_value($field)
    {
        if (!empty($_SESSION['set_value'][$field])) {
            echo $_SESSION['set_value'][$field];
        }
    }

    public function session_destroy($session = [])
    {
        foreach ($session as $value) {
            unset($_SESSION[$value]);
        }
    }

    public function createId($lastId)
    {
        $userId = 'ID';
        $id = substr($lastId, 2);

        $id = (int)$id;

        $uniqIdNumber = $id + 1;
        if (strlen($uniqIdNumber) == 1) {
            $userId = $userId . '00' . $uniqIdNumber;
        } else if (strlen($uniqIdNumber) == 2) {
            $userId = $userId . '0' . $uniqIdNumber;
        } else {
            $userId = $userId . $uniqIdNumber;
        }
        return $userId;
    }

    public function uriSegment($index)
    {
        $url = $this->trimUrl();

        array_splice($url, 0, 7);
        return $url[$index];
    }

    public function checkTypeFile($fileName)
    {
        $extension = end(explode('.', $fileName));

        return $extension;
    }

    public function getAllMenu()
    {
        $menu = $this->model->getMenuByUser();
        return $menu;
    }

    public function getMenu()
    {
        $menu = $this->model->getMenuByUser(0);
        return $menu;
    }

    public function getSubMenu()
    {
        $subMenu = $this->model->getSubMenuByUser();
        return $subMenu;
    }

    public function checkPermission($permissionName)
    {
        // $allPermission = $this->model->getPermissionByMenuId($menu_id);
        // var_dump($this->uriSegment())
        $menu = $this->trimUrl()[5];

        $validPermission = $this->model->checkPermission($menu, $permissionName);

        return !empty($validPermission) ? true : false;
    }

    public function trimUrl()
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }

    public function getIcons()
    {
        $icons = '';
        $icons .= '<ul class="icons-preview" id="linearicons">';
        $icons .= '<li class="btn-icon"><span class="icon-home"></span><span class="name form-icon">icon-home</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-home2"></span><span class="name form-icon">icon-home2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-home3"></span><span class="name form-icon">icon-home3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-home4"></span><span class="name form-icon">icon-home4</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-home5"></span><span class="name form-icon">icon-home5</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-home6"></span><span class="name form-icon">icon-home6</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bathtub"></span><span class="name form-icon">icon-bathtub</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-toothbrush"></span><span class="name form-icon">icon-toothbrush</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bed"></span><span class="name form-icon">icon-bed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-couch"></span><span class="name form-icon">icon-couch</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chair"></span><span class="name form-icon">icon-chair</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-city"></span><span class="name form-icon">icon-city</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-apartment"></span><span class="name form-icon">icon-apartment</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil"></span><span class="name form-icon">icon-pencil</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil2"></span><span class="name form-icon">icon-pencil2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pen"></span><span class="name form-icon">icon-pen</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil3"></span><span class="name form-icon">icon-pencil3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eraser"></span><span class="name form-icon">icon-eraser</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil4"></span><span class="name form-icon">icon-pencil4</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil5"></span><span class="name form-icon">icon-pencil5</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-feather"></span><span class="name form-icon">icon-feather</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-feather2"></span><span class="name form-icon">icon-feather2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-feather3"></span><span class="name form-icon">icon-feather3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pen2"></span><span class="name form-icon">icon-pen2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pen-add"></span><span class="name form-icon">icon-pen-add</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pen-remove"></span><span class="name form-icon">icon-pen-remove</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-vector"></span><span class="name form-icon">icon-vector</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pen3"></span><span class="name form-icon">icon-pen3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-blog"></span><span class="name form-icon">icon-blog</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-brush"></span><span class="name form-icon">icon-brush</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-brush2"></span><span class="name form-icon">icon-brush2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-spray"></span><span class="name form-icon">icon-spray</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-paint-roller"></span><span class="name form-icon">icon-paint-roller</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-stamp"></span><span class="name form-icon">icon-stamp</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tape"></span><span class="name form-icon">icon-tape</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-desk-tape"></span><span class="name form-icon">icon-desk-tape</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-texture"></span><span class="name form-icon">icon-texture</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eye-dropper"></span><span class="name form-icon">icon-eye-dropper</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-palette"></span><span class="name form-icon">icon-palette</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-color-sampler"></span><span class="name form-icon">icon-color-sampler</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bucket"></span><span class="name form-icon">icon-bucket</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gradient"></span><span class="name form-icon">icon-gradient</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gradient2"></span><span class="name form-icon">icon-gradient2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-magic-wand"></span><span class="name form-icon">icon-magic-wand</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-magnet"></span><span class="name form-icon">icon-magnet</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil-ruler"></span><span class="name form-icon">icon-pencil-ruler</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil-ruler2"></span><span class="name form-icon">icon-pencil-ruler2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-compass"></span><span class="name form-icon">icon-compass</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-aim"></span><span class="name form-icon">icon-aim</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gun"></span><span class="name form-icon">icon-gun</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bottle"></span><span class="name form-icon">icon-bottle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-drop"></span><span class="name form-icon">icon-drop</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-drop-crossed"></span><span class="name form-icon">icon-drop-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-drop2"></span><span class="name form-icon">icon-drop2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-snow"></span><span class="name form-icon">icon-snow</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-snow2"></span><span class="name form-icon">icon-snow2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fire"></span><span class="name form-icon">icon-fire</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-lighter"></span><span class="name form-icon">icon-lighter</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-knife"></span><span class="name form-icon">icon-knife</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dagger"></span><span class="name form-icon">icon-dagger</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tissue"></span><span class="name form-icon">icon-tissue</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-toilet-paper"></span><span class="name form-icon">icon-toilet-paper</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-poop"></span><span class="name form-icon">icon-poop</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-umbrella"></span><span class="name form-icon">icon-umbrella</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-umbrella2"></span><span class="name form-icon">icon-umbrella2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-rain"></span><span class="name form-icon">icon-rain</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tornado"></span><span class="name form-icon">icon-tornado</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wind"></span><span class="name form-icon">icon-wind</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fan"></span><span class="name form-icon">icon-fan</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-contrast"></span><span class="name form-icon">icon-contrast</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sun-small"></span><span class="name form-icon">icon-sun-small</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sun"></span><span class="name form-icon">icon-sun</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sun2"></span><span class="name form-icon">icon-sun2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-moon"></span><span class="name form-icon">icon-moon</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud"></span><span class="name form-icon">icon-cloud</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-upload"></span><span class="name form-icon">icon-cloud-upload</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-download"></span><span class="name form-icon">icon-cloud-download</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-rain"></span><span class="name form-icon">icon-cloud-rain</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-hailstones"></span><span class="name form-icon">icon-cloud-hailstones</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-snow"></span><span class="name form-icon">icon-cloud-snow</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-windy"></span><span class="name form-icon">icon-cloud-windy</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sun-wind"></span><span class="name form-icon">icon-sun-wind</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-fog"></span><span class="name form-icon">icon-cloud-fog</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-sun"></span><span class="name form-icon">icon-cloud-sun</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-lightning"></span><span class="name form-icon">icon-cloud-lightning</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-sync"></span><span class="name form-icon">icon-cloud-sync</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-lock"></span><span class="name form-icon">icon-cloud-lock</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-gear"></span><span class="name form-icon">icon-cloud-gear</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-alert"></span><span class="name form-icon">icon-cloud-alert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-check"></span><span class="name form-icon">icon-cloud-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-cross"></span><span class="name form-icon">icon-cloud-cross</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-crossed"></span><span class="name form-icon">icon-cloud-crossed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cloud-database"></span><span class="name form-icon">icon-cloud-database</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-database"></span><span class="name form-icon">icon-database</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-add"></span><span class="name form-icon">icon-database-add</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-remove"></span><span class="name form-icon">icon-database-remove</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-lock"></span><span class="name form-icon">icon-database-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-refresh"></span><span class="name form-icon">icon-database-refresh</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-check"></span><span class="name form-icon">icon-database-check</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-history"></span><span class="name form-icon">icon-database-history</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-upload"></span><span class="name form-icon">icon-database-upload</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-database-download"></span><span class="name form-icon">icon-database-download</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-server"></span><span class="name form-icon">icon-server</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shield"></span><span class="name form-icon">icon-shield</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shield-check"></span><span class="name form-icon">icon-shield-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-shield-alert"></span><span class="name form-icon">icon-shield-alert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-shield-cross"></span><span class="name form-icon">icon-shield-cross</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-lock"></span><span class="name form-icon">icon-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-rotation-lock"></span><span class="name form-icon">icon-rotation-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-unlock"></span><span class="name form-icon">icon-unlock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-key"></span><span class="name form-icon">icon-key</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-key-hole"></span><span class="name form-icon">icon-key-hole</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-toggle-off"></span><span class="name form-icon">icon-toggle-off</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-toggle-on"></span><span class="name form-icon">icon-toggle-on</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cog"></span><span class="name form-icon">icon-cog</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cog2"></span><span class="name form-icon">icon-cog2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wrench"></span><span class="name form-icon">icon-wrench</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-screwdriver"></span><span class="name form-icon">icon-screwdriver</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-hammer-wrench"></span><span class="name form-icon">icon-hammer-wrench</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hammer"></span><span class="name form-icon">icon-hammer</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-saw"></span><span class="name form-icon">icon-saw</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-axe"></span><span class="name form-icon">icon-axe</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-axe2"></span><span class="name form-icon">icon-axe2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shovel"></span><span class="name form-icon">icon-shovel</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pickaxe"></span><span class="name form-icon">icon-pickaxe</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-factory"></span><span class="name form-icon">icon-factory</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-factory2"></span><span class="name form-icon">icon-factory2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-recycle"></span><span class="name form-icon">icon-recycle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trash"></span><span class="name form-icon">icon-trash</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trash2"></span><span class="name form-icon">icon-trash2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trash3"></span><span class="name form-icon">icon-trash3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-broom"></span><span class="name form-icon">icon-broom</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-game"></span><span class="name form-icon">icon-game</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gamepad"></span><span class="name form-icon">icon-gamepad</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-joystick"></span><span class="name form-icon">icon-joystick</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dice"></span><span class="name form-icon">icon-dice</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-spades"></span><span class="name form-icon">icon-spades</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-diamonds"></span><span class="name form-icon">icon-diamonds</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clubs"></span><span class="name form-icon">icon-clubs</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hearts"></span><span class="name form-icon">icon-hearts</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-heart"></span><span class="name form-icon">icon-heart</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-star"></span><span class="name form-icon">icon-star</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-star-half"></span><span class="name form-icon">icon-star-half</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-star-empty"></span><span class="name form-icon">icon-star-empty</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-flag"></span><span class="name form-icon">icon-flag</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flag2"></span><span class="name form-icon">icon-flag2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flag3"></span><span class="name form-icon">icon-flag3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mailbox-full"></span><span class="name form-icon">icon-mailbox-full</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-mailbox-empty"></span><span class="name form-icon">icon-mailbox-empty</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-at-sign"></span><span class="name form-icon">icon-at-sign</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-envelope"></span><span class="name form-icon">icon-envelope</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-envelope-open"></span><span class="name form-icon">icon-envelope-open</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-paperclip"></span><span class="name form-icon">icon-paperclip</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-paper-plane"></span><span class="name form-icon">icon-paper-plane</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-reply"></span><span class="name form-icon">icon-reply</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-reply-all"></span><span class="name form-icon">icon-reply-all</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-inbox"></span><span class="name form-icon">icon-inbox</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-inbox2"></span><span class="name form-icon">icon-inbox2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-outbox"></span><span class="name form-icon">icon-outbox</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-box"></span><span class="name form-icon">icon-box</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-archive"></span><span class="name form-icon">icon-archive</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-archive2"></span><span class="name form-icon">icon-archive2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-drawers"></span><span class="name form-icon">icon-drawers</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-drawers2"></span><span class="name form-icon">icon-drawers2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-drawers3"></span><span class="name form-icon">icon-drawers3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eye"></span><span class="name form-icon">icon-eye</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eye-crossed"></span><span class="name form-icon">icon-eye-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-eye-plus"></span><span class="name form-icon">icon-eye-plus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eye-minus"></span><span class="name form-icon">icon-eye-minus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-binoculars"></span><span class="name form-icon">icon-binoculars</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-binoculars2"></span><span class="name form-icon">icon-binoculars2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-hdd"></span><span class="name form-icon">icon-hdd</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hdd-down"></span><span class="name form-icon">icon-hdd-down</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hdd-up"></span><span class="name form-icon">icon-hdd-up</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-floppy-disk"></span><span class="name form-icon">icon-floppy-disk</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-disc"></span><span class="name form-icon">icon-disc</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tape2"></span><span class="name form-icon">icon-tape2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-printer"></span><span class="name form-icon">icon-printer</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shredder"></span><span class="name form-icon">icon-shredder</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-empty"></span><span class="name form-icon">icon-file-empty</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-add"></span><span class="name form-icon">icon-file-add</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-check"></span><span class="name form-icon">icon-file-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-lock"></span><span class="name form-icon">icon-file-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-files"></span><span class="name form-icon">icon-files</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-copy"></span><span class="name form-icon">icon-copy</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-compare"></span><span class="name form-icon">icon-compare</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder"></span><span class="name form-icon">icon-folder</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-search"></span><span class="name form-icon">icon-folder-search</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-plus"></span><span class="name form-icon">icon-folder-plus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-minus"></span><span class="name form-icon">icon-folder-minus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-download"></span><span class="name form-icon">icon-folder-download</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-upload"></span><span class="name form-icon">icon-folder-upload</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-star"></span><span class="name form-icon">icon-folder-star</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-heart"></span><span class="name form-icon">icon-folder-heart</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-user"></span><span class="name form-icon">icon-folder-user</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-shared"></span><span class="name form-icon">icon-folder-shared</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-music"></span><span class="name form-icon">icon-folder-music</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-picture"></span><span class="name form-icon">icon-folder-picture</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-folder-film"></span><span class="name form-icon">icon-folder-film</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-scissors"></span><span class="name form-icon">icon-scissors</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-paste"></span><span class="name form-icon">icon-paste</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-empty"></span><span class="name form-icon">icon-clipboard-empty</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-pencil"></span><span class="name form-icon">icon-clipboard-pencil</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-text"></span><span class="name form-icon">icon-clipboard-text</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-check"></span><span class="name form-icon">icon-clipboard-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-down"></span><span class="name form-icon">icon-clipboard-down</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-left"></span><span class="name form-icon">icon-clipboard-left</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-alert"></span><span class="name form-icon">icon-clipboard-alert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-clipboard-user"></span><span class="name form-icon">icon-clipboard-user</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-register"></span><span class="name form-icon">icon-register</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter"></span><span class="name form-icon">icon-enter</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit"></span><span class="name form-icon">icon-exit</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-papers"></span><span class="name form-icon">icon-papers</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-news"></span><span class="name form-icon">icon-news</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-reading"></span><span class="name form-icon">icon-reading</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-typewriter"></span><span class="name form-icon">icon-typewriter</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-document"></span><span class="name form-icon">icon-document</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-document2"></span><span class="name form-icon">icon-document2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-graduation-hat"></span><span class="name form-icon">icon-graduation-hat</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-license"></span><span class="name form-icon">icon-license</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-license2"></span><span class="name form-icon">icon-license2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-medal-empty"></span><span class="name form-icon">icon-medal-empty</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-medal-first"></span><span class="name form-icon">icon-medal-first</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-medal-second"></span><span class="name form-icon">icon-medal-second</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-medal-third"></span><span class="name form-icon">icon-medal-third</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-podium"></span><span class="name form-icon">icon-podium</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trophy"></span><span class="name form-icon">icon-trophy</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trophy2"></span><span class="name form-icon">icon-trophy2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-music-note"></span><span class="name form-icon">icon-music-note</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-music-note2"></span><span class="name form-icon">icon-music-note2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-music-note3"></span><span class="name form-icon">icon-music-note3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-playlist"></span><span class="name form-icon">icon-playlist</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-playlist-add"></span><span class="name form-icon">icon-playlist-add</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-guitar"></span><span class="name form-icon">icon-guitar</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trumpet"></span><span class="name form-icon">icon-trumpet</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-album"></span><span class="name form-icon">icon-album</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shuffle"></span><span class="name form-icon">icon-shuffle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-repeat-one"></span><span class="name form-icon">icon-repeat-one</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-repeat"></span><span class="name form-icon">icon-repeat</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-headphones"></span><span class="name form-icon">icon-headphones</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-headset"></span><span class="name form-icon">icon-headset</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loudspeaker"></span><span class="name form-icon">icon-loudspeaker</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-equalizer"></span><span class="name form-icon">icon-equalizer</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-theater"></span><span class="name form-icon">icon-theater</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-3d-glasses"></span><span class="name form-icon">icon-3d-glasses</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-ticket"></span><span class="name form-icon">icon-ticket</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-presentation"></span><span class="name form-icon">icon-presentation</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-play"></span><span class="name form-icon">icon-play</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-film-play"></span><span class="name form-icon">icon-film-play</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clapboard-play"></span><span class="name form-icon">icon-clapboard-play</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-media"></span><span class="name form-icon">icon-media</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-film"></span><span class="name form-icon">icon-film</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-film2"></span><span class="name form-icon">icon-film2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-surveillance"></span><span class="name form-icon">icon-surveillance</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-surveillance2"></span><span class="name form-icon">icon-surveillance2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-camera"></span><span class="name form-icon">icon-camera</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-camera-crossed"></span><span class="name form-icon">icon-camera-crossed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-camera-play"></span><span class="name form-icon">icon-camera-play</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-time-lapse"></span><span class="name form-icon">icon-time-lapse</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-record"></span><span class="name form-icon">icon-record</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-camera2"></span><span class="name form-icon">icon-camera2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-camera-flip"></span><span class="name form-icon">icon-camera-flip</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-panorama"></span><span class="name form-icon">icon-panorama</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-time-lapse2"></span><span class="name form-icon">icon-time-lapse2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-shutter"></span><span class="name form-icon">icon-shutter</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shutter2"></span><span class="name form-icon">icon-shutter2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-face-detection"></span><span class="name form-icon">icon-face-detection</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flare"></span><span class="name form-icon">icon-flare</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-convex"></span><span class="name form-icon">icon-convex</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-concave"></span><span class="name form-icon">icon-concave</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-picture"></span><span class="name form-icon">icon-picture</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-picture2"></span><span class="name form-icon">icon-picture2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-picture3"></span><span class="name form-icon">icon-picture3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pictures"></span><span class="name form-icon">icon-pictures</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-book"></span><span class="name form-icon">icon-book</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-audio-book"></span><span class="name form-icon">icon-audio-book</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-book2"></span><span class="name form-icon">icon-book2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bookmark"></span><span class="name form-icon">icon-bookmark</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bookmark2"></span><span class="name form-icon">icon-bookmark2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-label"></span><span class="name form-icon">icon-label</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-library"></span><span class="name form-icon">icon-library</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-library2"></span><span class="name form-icon">icon-library2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-contacts"></span><span class="name form-icon">icon-contacts</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-profile"></span><span class="name form-icon">icon-profile</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-portrait"></span><span class="name form-icon">icon-portrait</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-portrait2"></span><span class="name form-icon">icon-portrait2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-user"></span><span class="name form-icon">icon-user</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-user-plus"></span><span class="name form-icon">icon-user-plus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-user-minus"></span><span class="name form-icon">icon-user-minus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-user-lock"></span><span class="name form-icon">icon-user-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-users"></span><span class="name form-icon">icon-users</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-users2"></span><span class="name form-icon">icon-users2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-users-plus"></span><span class="name form-icon">icon-users-plus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-users-minus"></span><span class="name form-icon">icon-users-minus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-group-work"></span><span class="name form-icon">icon-group-work</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-woman"></span><span class="name form-icon">icon-woman</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-man"></span><span class="name form-icon">icon-man</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-baby"></span><span class="name form-icon">icon-baby</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-baby2"></span><span class="name form-icon">icon-baby2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-baby3"></span><span class="name form-icon">icon-baby3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-baby-bottle"></span><span class="name form-icon">icon-baby-bottle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-walk"></span><span class="name form-icon">icon-walk</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hand-waving"></span><span class="name form-icon">icon-hand-waving</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-jump"></span><span class="name form-icon">icon-jump</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-run"></span><span class="name form-icon">icon-run</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-woman2"></span><span class="name form-icon">icon-woman2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-man2"></span><span class="name form-icon">icon-man2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-man-woman"></span><span class="name form-icon">icon-man-woman</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-height"></span><span class="name form-icon">icon-height</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-weight"></span><span class="name form-icon">icon-weight</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-scale"></span><span class="name form-icon">icon-scale</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-button"></span><span class="name form-icon">icon-button</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bow-tie"></span><span class="name form-icon">icon-bow-tie</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tie"></span><span class="name form-icon">icon-tie</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-socks"></span><span class="name form-icon">icon-socks</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shoe"></span><span class="name form-icon">icon-shoe</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shoes"></span><span class="name form-icon">icon-shoes</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hat"></span><span class="name form-icon">icon-hat</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pants"></span><span class="name form-icon">icon-pants</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shorts"></span><span class="name form-icon">icon-shorts</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flip-flops"></span><span class="name form-icon">icon-flip-flops</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-shirt"></span><span class="name form-icon">icon-shirt</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hanger"></span><span class="name form-icon">icon-hanger</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-laundry"></span><span class="name form-icon">icon-laundry</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-store"></span><span class="name form-icon">icon-store</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-haircut"></span><span class="name form-icon">icon-haircut</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-store-24"></span><span class="name form-icon">icon-store-24</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-barcode"></span><span class="name form-icon">icon-barcode</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-barcode2"></span><span class="name form-icon">icon-barcode2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-barcode3"></span><span class="name form-icon">icon-barcode3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cashier"></span><span class="name form-icon">icon-cashier</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bag"></span><span class="name form-icon">icon-bag</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bag2"></span><span class="name form-icon">icon-bag2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart"></span><span class="name form-icon">icon-cart</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-empty"></span><span class="name form-icon">icon-cart-empty</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-full"></span><span class="name form-icon">icon-cart-full</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-plus"></span><span class="name form-icon">icon-cart-plus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-plus2"></span><span class="name form-icon">icon-cart-plus2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-add"></span><span class="name form-icon">icon-cart-add</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-remove"></span><span class="name form-icon">icon-cart-remove</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cart-exchange"></span><span class="name form-icon">icon-cart-exchange</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tag"></span><span class="name form-icon">icon-tag</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tags"></span><span class="name form-icon">icon-tags</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-receipt"></span><span class="name form-icon">icon-receipt</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wallet"></span><span class="name form-icon">icon-wallet</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-credit-card"></span><span class="name form-icon">icon-credit-card</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cash-dollar"></span><span class="name form-icon">icon-cash-dollar</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cash-euro"></span><span class="name form-icon">icon-cash-euro</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cash-pound"></span><span class="name form-icon">icon-cash-pound</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cash-yen"></span><span class="name form-icon">icon-cash-yen</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bag-dollar"></span><span class="name form-icon">icon-bag-dollar</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bag-euro"></span><span class="name form-icon">icon-bag-euro</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bag-pound"></span><span class="name form-icon">icon-bag-pound</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bag-yen"></span><span class="name form-icon">icon-bag-yen</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-coin-dollar"></span><span class="name form-icon">icon-coin-dollar</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-coin-euro"></span><span class="name form-icon">icon-coin-euro</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-coin-pound"></span><span class="name form-icon">icon-coin-pound</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-coin-yen"></span><span class="name form-icon">icon-coin-yen</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calculator"></span><span class="name form-icon">icon-calculator</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-calculator2"></span><span class="name form-icon">icon-calculator2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-abacus"></span><span class="name form-icon">icon-abacus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-vault"></span><span class="name form-icon">icon-vault</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-telephone"></span><span class="name form-icon">icon-telephone</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-lock"></span><span class="name form-icon">icon-phone-lock</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-wave"></span><span class="name form-icon">icon-phone-wave</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-pause"></span><span class="name form-icon">icon-phone-pause</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-outgoing"></span><span class="name form-icon">icon-phone-outgoing</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-incoming"></span><span class="name form-icon">icon-phone-incoming</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-in-out"></span><span class="name form-icon">icon-phone-in-out</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-error"></span><span class="name form-icon">icon-phone-error</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-sip"></span><span class="name form-icon">icon-phone-sip</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-plus"></span><span class="name form-icon">icon-phone-plus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-minus"></span><span class="name form-icon">icon-phone-minus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-voicemail"></span><span class="name form-icon">icon-voicemail</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dial"></span><span class="name form-icon">icon-dial</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-telephone2"></span><span class="name form-icon">icon-telephone2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pushpin"></span><span class="name form-icon">icon-pushpin</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pushpin2"></span><span class="name form-icon">icon-pushpin2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-map-marker"></span><span class="name form-icon">icon-map-marker</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-map-marker-user"></span><span class="name form-icon">icon-map-marker-user</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-map-marker-down"></span><span class="name form-icon">icon-map-marker-down</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-map-marker-check"></span><span class="name form-icon">icon-map-marker-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-map-marker-crossed"></span><span class="name">icon-map-marker-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-radar"></span><span class="name form-icon">icon-radar</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-compass2"></span><span class="name form-icon">icon-compass2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-map"></span><span class="name form-icon">icon-map</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-map2"></span><span class="name form-icon">icon-map2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-location"></span><span class="name form-icon">icon-location</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-road-sign"></span><span class="name form-icon">icon-road-sign</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-empty"></span><span class="name form-icon">icon-calendar-empty</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-check"></span><span class="name form-icon">icon-calendar-check</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-cross"></span><span class="name form-icon">icon-calendar-cross</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-31"></span><span class="name form-icon">icon-calendar-31</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-full"></span><span class="name form-icon">icon-calendar-full</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-insert"></span><span class="name form-icon">icon-calendar-insert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-text"></span><span class="name form-icon">icon-calendar-text</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-calendar-user"></span><span class="name form-icon">icon-calendar-user</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mouse"></span><span class="name form-icon">icon-mouse</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mouse-left"></span><span class="name form-icon">icon-mouse-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-mouse-right"></span><span class="name form-icon">icon-mouse-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-mouse-both"></span><span class="name form-icon">icon-mouse-both</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-keyboard"></span><span class="name form-icon">icon-keyboard</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-keyboard-up"></span><span class="name form-icon">icon-keyboard-up</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-keyboard-down"></span><span class="name form-icon">icon-keyboard-down</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-delete"></span><span class="name form-icon">icon-delete</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-spell-check"></span><span class="name form-icon">icon-spell-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-escape"></span><span class="name form-icon">icon-escape</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter2"></span><span class="name form-icon">icon-enter2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-screen"></span><span class="name form-icon">icon-screen</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-aspect-ratio"></span><span class="name form-icon">icon-aspect-ratio</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal"></span><span class="name form-icon">icon-signal</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-lock"></span><span class="name form-icon">icon-signal-lock</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-80"></span><span class="name form-icon">icon-signal-80</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-60"></span><span class="name form-icon">icon-signal-60</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-40"></span><span class="name form-icon">icon-signal-40</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-20"></span><span class="name form-icon">icon-signal-20</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-0"></span><span class="name form-icon">icon-signal-0</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-signal-blocked"></span><span class="name form-icon">icon-signal-blocked</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sim"></span><span class="name form-icon">icon-sim</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flash-memory"></span><span class="name form-icon">icon-flash-memory</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-usb-drive"></span><span class="name form-icon">icon-usb-drive</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone"></span><span class="name form-icon">icon-phone</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-smartphone"></span><span class="name form-icon">icon-smartphone</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-smartphone-notification"></span><span class="name">icon-smartphone-notification</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-smartphone-vibration"></span><span class="name">icon-smartphone-vibration</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-smartphone-embed"></span><span class="name form-icon">icon-smartphone-embed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-smartphone-waves"></span><span class="name form-icon">icon-smartphone-waves</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-tablet"></span><span class="name form-icon">icon-tablet</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tablet2"></span><span class="name form-icon">icon-tablet2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-laptop"></span><span class="name form-icon">icon-laptop</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-laptop-phone"></span><span class="name form-icon">icon-laptop-phone</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-desktop"></span><span class="name form-icon">icon-desktop</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-launch"></span><span class="name form-icon">icon-launch</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-new-tab"></span><span class="name form-icon">icon-new-tab</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-window"></span><span class="name form-icon">icon-window</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cable"></span><span class="name form-icon">icon-cable</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cable2"></span><span class="name form-icon">icon-cable2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tv"></span><span class="name form-icon">icon-tv</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-radio"></span><span class="name form-icon">icon-radio</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-remote-control"></span><span class="name form-icon">icon-remote-control</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-power-switch"></span><span class="name form-icon">icon-power-switch</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-power"></span><span class="name form-icon">icon-power</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-power-crossed"></span><span class="name form-icon">icon-power-crossed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flash-auto"></span><span class="name form-icon">icon-flash-auto</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-lamp"></span><span class="name form-icon">icon-lamp</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flashlight"></span><span class="name form-icon">icon-flashlight</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-lampshade"></span><span class="name form-icon">icon-lampshade</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cord"></span><span class="name form-icon">icon-cord</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-outlet"></span><span class="name form-icon">icon-outlet</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-power"></span><span class="name form-icon">icon-battery-power</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-empty"></span><span class="name form-icon">icon-battery-empty</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-alert"></span><span class="name form-icon">icon-battery-alert</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-error"></span><span class="name form-icon">icon-battery-error</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-low1"></span><span class="name form-icon">icon-battery-low1</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-low2"></span><span class="name form-icon">icon-battery-low2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-low3"></span><span class="name form-icon">icon-battery-low3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-mid1"></span><span class="name form-icon">icon-battery-mid1</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-mid2"></span><span class="name form-icon">icon-battery-mid2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-mid3"></span><span class="name form-icon">icon-battery-mid3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-full"></span><span class="name form-icon">icon-battery-full</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging"></span><span class="name form-icon">icon-battery-charging</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging2"></span><span class="name form-icon">icon-battery-charging2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging3"></span><span class="name form-icon">icon-battery-charging3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging4"></span><span class="name form-icon">icon-battery-charging4</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging5"></span><span class="name form-icon">icon-battery-charging5</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging6"></span><span class="name form-icon">icon-battery-charging6</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-battery-charging7"></span><span class="name form-icon">icon-battery-charging7</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chip"></span><span class="name form-icon">icon-chip</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chip-x64"></span><span class="name form-icon">icon-chip-x64</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chip-x86"></span><span class="name form-icon">icon-chip-x86</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble"></span><span class="name form-icon">icon-bubble</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubbles"></span><span class="name form-icon">icon-bubbles</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-dots"></span><span class="name form-icon">icon-bubble-dots</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-alert"></span><span class="name form-icon">icon-bubble-alert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-question"></span><span class="name form-icon">icon-bubble-question</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-text"></span><span class="name form-icon">icon-bubble-text</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-pencil"></span><span class="name form-icon">icon-bubble-pencil</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-picture"></span><span class="name form-icon">icon-bubble-picture</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-video"></span><span class="name form-icon">icon-bubble-video</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-user"></span><span class="name form-icon">icon-bubble-user</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-quote"></span><span class="name form-icon">icon-bubble-quote</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-heart"></span><span class="name form-icon">icon-bubble-heart</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-emoticon"></span><span class="name form-icon">icon-bubble-emoticon</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-bubble-attachment"></span><span class="name form-icon">icon-bubble-attachment</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-phone-bubble"></span><span class="name form-icon">icon-phone-bubble</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-quote-open"></span><span class="name form-icon">icon-quote-open</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-quote-close"></span><span class="name form-icon">icon-quote-close</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-dna"></span><span class="name form-icon">icon-dna</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-heart-pulse"></span><span class="name form-icon">icon-heart-pulse</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pulse"></span><span class="name form-icon">icon-pulse</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-syringe"></span><span class="name form-icon">icon-syringe</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pills"></span><span class="name form-icon">icon-pills</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-first-aid"></span><span class="name form-icon">icon-first-aid</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-lifebuoy"></span><span class="name form-icon">icon-lifebuoy</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bandage"></span><span class="name form-icon">icon-bandage</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bandages"></span><span class="name form-icon">icon-bandages</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-thermometer"></span><span class="name form-icon">icon-thermometer</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-microscope"></span><span class="name form-icon">icon-microscope</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-brain"></span><span class="name form-icon">icon-brain</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-beaker"></span><span class="name form-icon">icon-beaker</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-skull"></span><span class="name form-icon">icon-skull</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bone"></span><span class="name form-icon">icon-bone</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-construction"></span><span class="name form-icon">icon-construction</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-construction-cone"></span><span class="name form-icon">icon-construction-cone</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pie-chart"></span><span class="name form-icon">icon-pie-chart</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pie-chart2"></span><span class="name form-icon">icon-pie-chart2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-graph"></span><span class="name form-icon">icon-graph</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chart-growth"></span><span class="name form-icon">icon-chart-growth</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chart-bars"></span><span class="name form-icon">icon-chart-bars</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chart-settings"></span><span class="name form-icon">icon-chart-settings</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cake"></span><span class="name form-icon">icon-cake</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gift"></span><span class="name form-icon">icon-gift</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-balloon"></span><span class="name form-icon">icon-balloon</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-rank"></span><span class="name form-icon">icon-rank</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-rank2"></span><span class="name form-icon">icon-rank2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-rank3"></span><span class="name form-icon">icon-rank3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-crown"></span><span class="name form-icon">icon-crown</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-lotus"></span><span class="name form-icon">icon-lotus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-diamond"></span><span class="name form-icon">icon-diamond</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-diamond2"></span><span class="name form-icon">icon-diamond2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-diamond3"></span><span class="name form-icon">icon-diamond3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-diamond4"></span><span class="name form-icon">icon-diamond4</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-linearicons"></span><span class="name form-icon">icon-linearicons</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-teacup"></span><span class="name form-icon">icon-teacup</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-teapot"></span><span class="name form-icon">icon-teapot</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-glass"></span><span class="name form-icon">icon-glass</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bottle2"></span><span class="name form-icon">icon-bottle2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-glass-cocktail"></span><span class="name form-icon">icon-glass-cocktail</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-glass2"></span><span class="name form-icon">icon-glass2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dinner"></span><span class="name form-icon">icon-dinner</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dinner2"></span><span class="name form-icon">icon-dinner2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chef"></span><span class="name form-icon">icon-chef</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-scale2"></span><span class="name form-icon">icon-scale2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-egg"></span><span class="name form-icon">icon-egg</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-egg2"></span><span class="name form-icon">icon-egg2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eggs"></span><span class="name form-icon">icon-eggs</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-platter"></span><span class="name form-icon">icon-platter</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-steak"></span><span class="name form-icon">icon-steak</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hamburger"></span><span class="name form-icon">icon-hamburger</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hotdog"></span><span class="name form-icon">icon-hotdog</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pizza"></span><span class="name form-icon">icon-pizza</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sausage"></span><span class="name form-icon">icon-sausage</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chicken"></span><span class="name form-icon">icon-chicken</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fish"></span><span class="name form-icon">icon-fish</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-carrot"></span><span class="name form-icon">icon-carrot</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cheese"></span><span class="name form-icon">icon-cheese</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bread"></span><span class="name form-icon">icon-bread</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ice-cream"></span><span class="name form-icon">icon-ice-cream</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ice-cream2"></span><span class="name form-icon">icon-ice-cream2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-candy"></span><span class="name form-icon">icon-candy</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-lollipop"></span><span class="name form-icon">icon-lollipop</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-coffee-bean"></span><span class="name form-icon">icon-coffee-bean</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-coffee-cup"></span><span class="name form-icon">icon-coffee-cup</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cherry"></span><span class="name form-icon">icon-cherry</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-grapes"></span><span class="name form-icon">icon-grapes</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-citrus"></span><span class="name form-icon">icon-citrus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-apple"></span><span class="name form-icon">icon-apple</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-leaf"></span><span class="name form-icon">icon-leaf</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-landscape"></span><span class="name form-icon">icon-landscape</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pine-tree"></span><span class="name form-icon">icon-pine-tree</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tree"></span><span class="name form-icon">icon-tree</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cactus"></span><span class="name form-icon">icon-cactus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-paw"></span><span class="name form-icon">icon-paw</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-footprint"></span><span class="name form-icon">icon-footprint</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-speed-slow"></span><span class="name form-icon">icon-speed-slow</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-speed-medium"></span><span class="name form-icon">icon-speed-medium</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-speed-fast"></span><span class="name form-icon">icon-speed-fast</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-rocket"></span><span class="name form-icon">icon-rocket</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hammer2"></span><span class="name form-icon">icon-hammer2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-balance"></span><span class="name form-icon">icon-balance</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-briefcase"></span><span class="name form-icon">icon-briefcase</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-luggage-weight"></span><span class="name form-icon">icon-luggage-weight</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dolly"></span><span class="name form-icon">icon-dolly</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-plane"></span><span class="name form-icon">icon-plane</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-plane-crossed"></span><span class="name form-icon">icon-plane-crossed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-helicopter"></span><span class="name form-icon">icon-helicopter</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-traffic-lights"></span><span class="name form-icon">icon-traffic-lights</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-siren"></span><span class="name form-icon">icon-siren</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-road"></span><span class="name form-icon">icon-road</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-engine"></span><span class="name form-icon">icon-engine</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-oil-pressure"></span><span class="name form-icon">icon-oil-pressure</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-coolant-temperature"></span><span class="name">icon-coolant-temperature</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-battery"></span><span class="name form-icon">icon-car-battery</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-gas"></span><span class="name form-icon">icon-gas</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gallon"></span><span class="name form-icon">icon-gallon</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-transmission"></span><span class="name form-icon">icon-transmission</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-car"></span><span class="name form-icon">icon-car</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-wash"></span><span class="name form-icon">icon-car-wash</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-wash2"></span><span class="name form-icon">icon-car-wash2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bus"></span><span class="name form-icon">icon-bus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bus2"></span><span class="name form-icon">icon-bus2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car2"></span><span class="name form-icon">icon-car2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-parking"></span><span class="name form-icon">icon-parking</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-lock"></span><span class="name form-icon">icon-car-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-taxi"></span><span class="name form-icon">icon-taxi</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-siren"></span><span class="name form-icon">icon-car-siren</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-wash3"></span><span class="name form-icon">icon-car-wash3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-car-wash4"></span><span class="name form-icon">icon-car-wash4</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ambulance"></span><span class="name form-icon">icon-ambulance</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-truck"></span><span class="name form-icon">icon-truck</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-trailer"></span><span class="name form-icon">icon-trailer</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-scale-truck"></span><span class="name form-icon">icon-scale-truck</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-train"></span><span class="name form-icon">icon-train</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ship"></span><span class="name form-icon">icon-ship</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ship2"></span><span class="name form-icon">icon-ship2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-anchor"></span><span class="name form-icon">icon-anchor</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-boat"></span><span class="name form-icon">icon-boat</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bicycle"></span><span class="name form-icon">icon-bicycle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bicycle2"></span><span class="name form-icon">icon-bicycle2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dumbbell"></span><span class="name form-icon">icon-dumbbell</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bench-press"></span><span class="name form-icon">icon-bench-press</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-swim"></span><span class="name form-icon">icon-swim</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-football"></span><span class="name form-icon">icon-football</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-baseball-bat"></span><span class="name form-icon">icon-baseball-bat</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-baseball"></span><span class="name form-icon">icon-baseball</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tennis"></span><span class="name form-icon">icon-tennis</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tennis2"></span><span class="name form-icon">icon-tennis2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ping-pong"></span><span class="name form-icon">icon-ping-pong</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hockey"></span><span class="name form-icon">icon-hockey</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-8ball"></span><span class="name form-icon">icon-8ball</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bowling"></span><span class="name form-icon">icon-bowling</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bowling-pins"></span><span class="name form-icon">icon-bowling-pins</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-golf"></span><span class="name form-icon">icon-golf</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-golf2"></span><span class="name form-icon">icon-golf2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-archery"></span><span class="name form-icon">icon-archery</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-slingshot"></span><span class="name form-icon">icon-slingshot</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-soccer"></span><span class="name form-icon">icon-soccer</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-basketball"></span><span class="name form-icon">icon-basketball</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cube"></span><span class="name form-icon">icon-cube</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-3d-rotate"></span><span class="name form-icon">icon-3d-rotate</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-puzzle"></span><span class="name form-icon">icon-puzzle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-glasses"></span><span class="name form-icon">icon-glasses</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-glasses2"></span><span class="name form-icon">icon-glasses2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-accessibility"></span><span class="name form-icon">icon-accessibility</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wheelchair"></span><span class="name form-icon">icon-wheelchair</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-wall"></span><span class="name form-icon">icon-wall</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fence"></span><span class="name form-icon">icon-fence</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wall2"></span><span class="name form-icon">icon-wall2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-icons"></span><span class="name form-icon">icon-icons</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-resize-handle"></span><span class="name form-icon">icon-resize-handle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-icons2"></span><span class="name form-icon">icon-icons2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-select"></span><span class="name form-icon">icon-select</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-select2"></span><span class="name form-icon">icon-select2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-site-map"></span><span class="name form-icon">icon-site-map</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-earth"></span><span class="name form-icon">icon-earth</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-earth-lock"></span><span class="name form-icon">icon-earth-lock</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-network"></span><span class="name form-icon">icon-network</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-network-lock"></span><span class="name form-icon">icon-network-lock</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-planet"></span><span class="name form-icon">icon-planet</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-happy"></span><span class="name form-icon">icon-happy</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-smile"></span><span class="name form-icon">icon-smile</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-grin"></span><span class="name form-icon">icon-grin</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tongue"></span><span class="name form-icon">icon-tongue</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sad"></span><span class="name form-icon">icon-sad</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wink"></span><span class="name form-icon">icon-wink</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-dream"></span><span class="name form-icon">icon-dream</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shocked"></span><span class="name form-icon">icon-shocked</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-shocked2"></span><span class="name form-icon">icon-shocked2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tongue2"></span><span class="name form-icon">icon-tongue2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-neutral"></span><span class="name form-icon">icon-neutral</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-happy-grin"></span><span class="name form-icon">icon-happy-grin</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cool"></span><span class="name form-icon">icon-cool</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mad"></span><span class="name form-icon">icon-mad</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-grin-evil"></span><span class="name form-icon">icon-grin-evil</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-evil"></span><span class="name form-icon">icon-evil</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wow"></span><span class="name form-icon">icon-wow</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-annoyed"></span><span class="name form-icon">icon-annoyed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wondering"></span><span class="name form-icon">icon-wondering</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-confused"></span><span class="name form-icon">icon-confused</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-zipped"></span><span class="name form-icon">icon-zipped</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-grumpy"></span><span class="name form-icon">icon-grumpy</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mustache"></span><span class="name form-icon">icon-mustache</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tombstone-hipster"></span><span class="name form-icon">icon-tombstone-hipster</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-tombstone"></span><span class="name form-icon">icon-tombstone</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ghost"></span><span class="name form-icon">icon-ghost</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ghost-hipster"></span><span class="name form-icon">icon-ghost-hipster</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-halloween"></span><span class="name form-icon">icon-halloween</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-christmas"></span><span class="name form-icon">icon-christmas</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-easter-egg"></span><span class="name form-icon">icon-easter-egg</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-mustache2"></span><span class="name form-icon">icon-mustache2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mustache-glasses"></span><span class="name form-icon">icon-mustache-glasses</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pipe"></span><span class="name form-icon">icon-pipe</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm"></span><span class="name form-icon">icon-alarm</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-add"></span><span class="name form-icon">icon-alarm-add</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-snooze"></span><span class="name form-icon">icon-alarm-snooze</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-ringing"></span><span class="name form-icon">icon-alarm-ringing</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bullhorn"></span><span class="name form-icon">icon-bullhorn</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-hearing"></span><span class="name form-icon">icon-hearing</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-volume-high"></span><span class="name form-icon">icon-volume-high</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-volume-medium"></span><span class="name form-icon">icon-volume-medium</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-volume-low"></span><span class="name form-icon">icon-volume-low</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-volume"></span><span class="name form-icon">icon-volume</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mute"></span><span class="name form-icon">icon-mute</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-lan"></span><span class="name form-icon">icon-lan</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-lan2"></span><span class="name form-icon">icon-lan2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi"></span><span class="name form-icon">icon-wifi</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-lock"></span><span class="name form-icon">icon-wifi-lock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-blocked"></span><span class="name form-icon">icon-wifi-blocked</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-mid"></span><span class="name form-icon">icon-wifi-mid</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-low"></span><span class="name form-icon">icon-wifi-low</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-low2"></span><span class="name form-icon">icon-wifi-low2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-alert"></span><span class="name form-icon">icon-wifi-alert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-alert-mid"></span><span class="name form-icon">icon-wifi-alert-mid</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-alert-low"></span><span class="name form-icon">icon-wifi-alert-low</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-wifi-alert-low2"></span><span class="name form-icon">icon-wifi-alert-low2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-stream"></span><span class="name form-icon">icon-stream</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-stream-check"></span><span class="name form-icon">icon-stream-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-stream-error"></span><span class="name form-icon">icon-stream-error</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-stream-alert"></span><span class="name form-icon">icon-stream-alert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-communication"></span><span class="name form-icon">icon-communication</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-communication-crossed"></span><span class="name">icon-communication-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-broadcast"></span><span class="name form-icon">icon-broadcast</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-antenna"></span><span class="name form-icon">icon-antenna</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-satellite"></span><span class="name form-icon">icon-satellite</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-satellite2"></span><span class="name form-icon">icon-satellite2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-mic"></span><span class="name form-icon">icon-mic</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mic-mute"></span><span class="name form-icon">icon-mic-mute</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-mic2"></span><span class="name form-icon">icon-mic2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-spotlights"></span><span class="name form-icon">icon-spotlights</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-hourglass"></span><span class="name form-icon">icon-hourglass</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loading"></span><span class="name form-icon">icon-loading</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loading2"></span><span class="name form-icon">icon-loading2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loading3"></span><span class="name form-icon">icon-loading3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-refresh"></span><span class="name form-icon">icon-refresh</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-refresh2"></span><span class="name form-icon">icon-refresh2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-undo"></span><span class="name form-icon">icon-undo</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-redo"></span><span class="name form-icon">icon-redo</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-jump2"></span><span class="name form-icon">icon-jump2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-undo2"></span><span class="name form-icon">icon-undo2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-redo2"></span><span class="name form-icon">icon-redo2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sync"></span><span class="name form-icon">icon-sync</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-repeat-one2"></span><span class="name form-icon">icon-repeat-one2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sync-crossed"></span><span class="name form-icon">icon-sync-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sync2"></span><span class="name form-icon">icon-sync2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-repeat-one3"></span><span class="name form-icon">icon-repeat-one3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sync-crossed2"></span><span class="name form-icon">icon-sync-crossed2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-return"></span><span class="name form-icon">icon-return</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-return2"></span><span class="name form-icon">icon-return2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-refund"></span><span class="name form-icon">icon-refund</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-history"></span><span class="name form-icon">icon-history</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-history2"></span><span class="name form-icon">icon-history2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-self-timer"></span><span class="name form-icon">icon-self-timer</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-clock"></span><span class="name form-icon">icon-clock</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clock2"></span><span class="name form-icon">icon-clock2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-clock3"></span><span class="name form-icon">icon-clock3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-watch"></span><span class="name form-icon">icon-watch</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm2"></span><span class="name form-icon">icon-alarm2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-add2"></span><span class="name form-icon">icon-alarm-add2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-remove"></span><span class="name form-icon">icon-alarm-remove</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-check"></span><span class="name form-icon">icon-alarm-check</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-alarm-error"></span><span class="name form-icon">icon-alarm-error</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-timer"></span><span class="name form-icon">icon-timer</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-timer-crossed"></span><span class="name form-icon">icon-timer-crossed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-timer2"></span><span class="name form-icon">icon-timer2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-timer-crossed2"></span><span class="name form-icon">icon-timer-crossed2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-download"></span><span class="name form-icon">icon-download</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-upload"></span><span class="name form-icon">icon-upload</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-download2"></span><span class="name form-icon">icon-download2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-upload2"></span><span class="name form-icon">icon-upload2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-up"></span><span class="name form-icon">icon-enter-up</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-down"></span><span class="name form-icon">icon-enter-down</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-left"></span><span class="name form-icon">icon-enter-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-right"></span><span class="name form-icon">icon-enter-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-up"></span><span class="name form-icon">icon-exit-up</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-down"></span><span class="name form-icon">icon-exit-down</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-left"></span><span class="name form-icon">icon-exit-left</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-right"></span><span class="name form-icon">icon-exit-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-up2"></span><span class="name form-icon">icon-enter-up2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-down2"></span><span class="name form-icon">icon-enter-down2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-vertical"></span><span class="name form-icon">icon-enter-vertical</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-left2"></span><span class="name form-icon">icon-enter-left2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-right2"></span><span class="name form-icon">icon-enter-right2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-enter-horizontal"></span><span class="name form-icon">icon-enter-horizontal</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-up2"></span><span class="name form-icon">icon-exit-up2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-down2"></span><span class="name form-icon">icon-exit-down2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-left2"></span><span class="name form-icon">icon-exit-left2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-exit-right2"></span><span class="name form-icon">icon-exit-right2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cli"></span><span class="name form-icon">icon-cli</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bug"></span><span class="name form-icon">icon-bug</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-code"></span><span class="name form-icon">icon-code</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-code"></span><span class="name form-icon">icon-file-code</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-image"></span><span class="name form-icon">icon-file-image</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-zip"></span><span class="name form-icon">icon-file-zip</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-audio"></span><span class="name form-icon">icon-file-audio</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-video"></span><span class="name form-icon">icon-file-video</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-preview"></span><span class="name form-icon">icon-file-preview</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-charts"></span><span class="name form-icon">icon-file-charts</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-stats"></span><span class="name form-icon">icon-file-stats</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-spreadsheet"></span><span class="name form-icon">icon-file-spreadsheet</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-link"></span><span class="name form-icon">icon-link</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-unlink"></span><span class="name form-icon">icon-unlink</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-link2"></span><span class="name form-icon">icon-link2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-unlink2"></span><span class="name form-icon">icon-unlink2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-thumbs-up"></span><span class="name form-icon">icon-thumbs-up</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-thumbs-down"></span><span class="name form-icon">icon-thumbs-down</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-thumbs-up2"></span><span class="name form-icon">icon-thumbs-up2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-thumbs-down2"></span><span class="name form-icon">icon-thumbs-down2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-thumbs-up3"></span><span class="name form-icon">icon-thumbs-up3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-thumbs-down3"></span><span class="name form-icon">icon-thumbs-down3</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-share"></span><span class="name form-icon">icon-share</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-share2"></span><span class="name form-icon">icon-share2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-share3"></span><span class="name form-icon">icon-share3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-magnifier"></span><span class="name form-icon">icon-magnifier</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-file-search"></span><span class="name form-icon">icon-file-search</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-find-replace"></span><span class="name form-icon">icon-find-replace</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-zoom-in"></span><span class="name form-icon">icon-zoom-in</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-zoom-out"></span><span class="name form-icon">icon-zoom-out</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loupe"></span><span class="name form-icon">icon-loupe</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loupe-zoom-in"></span><span class="name form-icon">icon-loupe-zoom-in</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-loupe-zoom-out"></span><span class="name form-icon">icon-loupe-zoom-out</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cross"></span><span class="name form-icon">icon-cross</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-menu"></span><span class="name form-icon">icon-menu</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-list"></span><span class="name form-icon">icon-list</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-list2"></span><span class="name form-icon">icon-list2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-list3"></span><span class="name form-icon">icon-list3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-menu2"></span><span class="name form-icon">icon-menu2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-list4"></span><span class="name form-icon">icon-list4</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-menu3"></span><span class="name form-icon">icon-menu3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exclamation"></span><span class="name form-icon">icon-exclamation</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-question"></span><span class="name form-icon">icon-question</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-check"></span><span class="name form-icon">icon-check</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-cross2"></span><span class="name form-icon">icon-cross2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-plus"></span><span class="name form-icon">icon-plus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-minus"></span><span class="name form-icon">icon-minus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-percent"></span><span class="name form-icon">icon-percent</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-up"></span><span class="name form-icon">icon-chevron-up</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-down"></span><span class="name form-icon">icon-chevron-down</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-left"></span><span class="name form-icon">icon-chevron-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-right"></span><span class="name form-icon">icon-chevron-right</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevrons-expand-vertical"></span><span class="name">icon-chevrons-expand-vertical</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevrons-expand-horizontal"></span><span class="name">icon-chevrons-expand-horizontal</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevrons-contract-vertical"></span><span class="name">icon-chevrons-contract-vertical</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevrons-contract-horizontal"></span><span
                    class="name">icon-chevrons-contract-horizontal</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-up"></span><span class="name form-icon">icon-arrow-up</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-down"></span><span class="name form-icon">icon-arrow-down</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-left"></span><span class="name form-icon">icon-arrow-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-right"></span><span class="name form-icon">icon-arrow-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-up-right"></span><span class="name form-icon">icon-arrow-up-right</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrows-merge"></span><span class="name form-icon">icon-arrows-merge</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrows-split"></span><span class="name form-icon">icon-arrows-split</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-divert"></span><span class="name form-icon">icon-arrow-divert</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-return"></span><span class="name form-icon">icon-arrow-return</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-expand"></span><span class="name form-icon">icon-expand</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-contract"></span><span class="name form-icon">icon-contract</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-expand2"></span><span class="name form-icon">icon-expand2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-contract2"></span><span class="name form-icon">icon-contract2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-move"></span><span class="name form-icon">icon-move</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-tab"></span><span class="name form-icon">icon-tab</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-wave"></span><span class="name form-icon">icon-arrow-wave</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-expand3"></span><span class="name form-icon">icon-expand3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-expand4"></span><span class="name form-icon">icon-expand4</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-contract3"></span><span class="name form-icon">icon-contract3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-notification"></span><span class="name form-icon">icon-notification</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-warning"></span><span class="name form-icon">icon-warning</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-notification-circle"></span><span class="name">icon-notification-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-question-circle"></span><span class="name form-icon">icon-question-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-menu-circle"></span><span class="name form-icon">icon-menu-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-checkmark-circle"></span><span class="name form-icon">icon-checkmark-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cross-circle"></span><span class="name form-icon">icon-cross-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-plus-circle"></span><span class="name form-icon">icon-plus-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-circle-minus"></span><span class="name form-icon">icon-circle-minus</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-percent-circle"></span><span class="name form-icon">icon-percent-circle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-up-circle"></span><span class="name form-icon">icon-arrow-up-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-down-circle"></span><span class="name form-icon">icon-arrow-down-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-left-circle"></span><span class="name form-icon">icon-arrow-left-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-right-circle"></span><span class="name">icon-arrow-right-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-up-circle"></span><span class="name form-icon">icon-chevron-up-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-down-circle"></span><span class="name">icon-chevron-down-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-left-circle"></span><span class="name">icon-chevron-left-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-right-circle"></span><span class="name">icon-chevron-right-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-backward-circle"></span><span class="name form-icon">icon-backward-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-first-circle"></span><span class="name form-icon">icon-first-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-previous-circle"></span><span class="name form-icon">icon-previous-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-stop-circle"></span><span class="name form-icon">icon-stop-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-play-circle"></span><span class="name form-icon">icon-play-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pause-circle"></span><span class="name form-icon">icon-pause-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-next-circle"></span><span class="name form-icon">icon-next-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-last-circle"></span><span class="name form-icon">icon-last-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-forward-circle"></span><span class="name form-icon">icon-forward-circle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-eject-circle"></span><span class="name form-icon">icon-eject-circle</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-crop"></span><span class="name form-icon">icon-crop</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-frame-expand"></span><span class="name form-icon">icon-frame-expand</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-frame-contract"></span><span class="name form-icon">icon-frame-contract</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-focus"></span><span class="name form-icon">icon-focus</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-transform"></span><span class="name form-icon">icon-transform</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-grid"></span><span class="name form-icon">icon-grid</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-grid-crossed"></span><span class="name form-icon">icon-grid-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-layers"></span><span class="name form-icon">icon-layers</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-layers-crossed"></span><span class="name form-icon">icon-layers-crossed</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-toggle"></span><span class="name form-icon">icon-toggle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-rulers"></span><span class="name form-icon">icon-rulers</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-ruler"></span><span class="name form-icon">icon-ruler</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-funnel"></span><span class="name form-icon">icon-funnel</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flip-horizontal"></span><span class="name form-icon">icon-flip-horizontal</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-flip-vertical"></span><span class="name form-icon">icon-flip-vertical</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-flip-horizontal2"></span><span class="name form-icon">icon-flip-horizontal2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-flip-vertical2"></span><span class="name form-icon">icon-flip-vertical2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-angle"></span><span class="name form-icon">icon-angle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-angle2"></span><span class="name form-icon">icon-angle2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-subtract"></span><span class="name form-icon">icon-subtract</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-combine"></span><span class="name form-icon">icon-combine</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-intersect"></span><span class="name form-icon">icon-intersect</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-exclude"></span><span class="name form-icon">icon-exclude</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-align-center-vertical"></span><span class="name">icon-align-center-vertical</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-align-right"></span><span class="name form-icon">icon-align-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-align-bottom"></span><span class="name form-icon">icon-align-bottom</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-align-left"></span><span class="name form-icon">icon-align-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-align-center-horizontal"></span><span class="name">icon-align-center-horizontal</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-align-top"></span><span class="name form-icon">icon-align-top</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-square"></span><span class="name form-icon">icon-square</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-plus-square"></span><span class="name form-icon">icon-plus-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-minus-square"></span><span class="name form-icon">icon-minus-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-percent-square"></span><span class="name form-icon">icon-percent-square</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-up-square"></span><span class="name form-icon">icon-arrow-up-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-down-square"></span><span class="name form-icon">icon-arrow-down-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-left-square"></span><span class="name form-icon">icon-arrow-left-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-arrow-right-square"></span><span class="name">icon-arrow-right-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-up-square"></span><span class="name form-icon">icon-chevron-up-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-down-square"></span><span class="name">icon-chevron-down-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-left-square"></span><span class="name">icon-chevron-left-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-chevron-right-square"></span><span class="name">icon-chevron-right-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-check-square"></span><span class="name form-icon">icon-check-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-cross-square"></span><span class="name form-icon">icon-cross-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-menu-square"></span><span class="name form-icon">icon-menu-square</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-prohibited"></span><span class="name form-icon">icon-prohibited</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-circle"></span><span class="name form-icon">icon-circle</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-radio-button"></span><span class="name form-icon">icon-radio-button</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-ligature"></span><span class="name form-icon">icon-ligature</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-format"></span><span class="name form-icon">icon-text-format</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-format-remove"></span><span class="name">icon-text-format-remove</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-size"></span><span class="name form-icon">icon-text-size</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-bold"></span><span class="name form-icon">icon-bold</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-italic"></span><span class="name form-icon">icon-italic</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-underline"></span><span class="name form-icon">icon-underline</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-strikethrough"></span><span class="name form-icon">icon-strikethrough</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-highlight"></span><span class="name form-icon">icon-highlight</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-align-left"></span><span class="name form-icon">icon-text-align-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-align-center"></span><span class="name form-icon">icon-text-align-center</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-align-right"></span><span class="name form-icon">icon-text-align-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-align-justify"></span><span class="name">icon-text-align-justify</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-line-spacing"></span><span class="name form-icon">icon-line-spacing</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-indent-increase"></span><span class="name form-icon">icon-indent-increase</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-indent-decrease"></span><span class="name form-icon">icon-indent-decrease</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-text-wrap"></span><span class="name form-icon">icon-text-wrap</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pilcrow"></span><span class="name form-icon">icon-pilcrow</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-direction-ltr"></span><span class="name form-icon">icon-direction-ltr</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-direction-rtl"></span><span class="name form-icon">icon-direction-rtl</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-page-break"></span><span class="name form-icon">icon-page-break</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-page-break2"></span><span class="name form-icon">icon-page-break2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-alpha-asc"></span><span class="name form-icon">icon-sort-alpha-asc</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-alpha-desc"></span><span class="name form-icon">icon-sort-alpha-desc</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-numeric-asc"></span><span class="name form-icon">icon-sort-numeric-asc</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-numeric-desc"></span><span class="name form-icon">icon-sort-numeric-desc</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-amount-asc"></span><span class="name form-icon">icon-sort-amount-asc</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-amount-desc"></span><span class="name form-icon">icon-sort-amount-desc</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-time-asc"></span><span class="name form-icon">icon-sort-time-asc</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sort-time-desc"></span><span class="name form-icon">icon-sort-time-desc</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-sigma"></span><span class="name form-icon">icon-sigma</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pencil-line"></span><span class="name form-icon">icon-pencil-line</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-hand"></span><span class="name form-icon">icon-hand</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-up"></span><span class="name form-icon">icon-pointer-up</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-right"></span><span class="name form-icon">icon-pointer-right</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-down"></span><span class="name form-icon">icon-pointer-down</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-left"></span><span class="name form-icon">icon-pointer-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-finger-tap"></span><span class="name form-icon">icon-finger-tap</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-tap"></span><span class="name form-icon">icon-fingers-tap</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-reminder"></span><span class="name form-icon">icon-reminder</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-crossed"></span><span class="name form-icon">icon-fingers-crossed</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-victory"></span><span class="name form-icon">icon-fingers-victory</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-gesture-zoom"></span><span class="name form-icon">icon-gesture-zoom</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-gesture-pinch"></span><span class="name form-icon">icon-gesture-pinch</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-horizontal"></span><span class="name">icon-fingers-scroll-horizontal</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-vertical"></span><span class="name">icon-fingers-scroll-vertical</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-left"></span><span class="name">icon-fingers-scroll-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-right"></span><span class="name">icon-fingers-scroll-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-hand2"></span><span class="name form-icon">icon-hand2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-up2"></span><span class="name form-icon">icon-pointer-up2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-right2"></span><span class="name form-icon">icon-pointer-right2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-down2"></span><span class="name form-icon">icon-pointer-down2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-pointer-left2"></span><span class="name form-icon">icon-pointer-left2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-finger-tap2"></span><span class="name form-icon">icon-finger-tap2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-tap2"></span><span class="name form-icon">icon-fingers-tap2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-reminder2"></span><span class="name form-icon">icon-reminder2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gesture-zoom2"></span><span class="name form-icon">icon-gesture-zoom2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-gesture-pinch2"></span><span class="name form-icon">icon-gesture-pinch2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-horizontal2"></span><span class="name">icon-fingers-scroll-horizontal2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-vertical2"></span><span class="name">icon-fingers-scroll-vertical2</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-left2"></span><span class="name">icon-fingers-scroll-left2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-right2"></span><span class="name">icon-fingers-scroll-right2</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-fingers-scroll-vertical3"></span><span class="name">icon-fingers-scroll-vertical3</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-style"></span><span class="name form-icon">icon-border-style</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-all"></span><span class="name form-icon">icon-border-all</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-outer"></span><span class="name form-icon">icon-border-outer</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-inner"></span><span class="name form-icon">icon-border-inner</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-top"></span><span class="name form-icon">icon-border-top</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-horizontal"></span><span class="name form-icon">icon-border-horizontal</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-bottom"></span><span class="name form-icon">icon-border-bottom</span></li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-left"></span><span class="name form-icon">icon-border-left</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-vertical"></span><span class="name form-icon">icon-border-vertical</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-right"></span><span class="name form-icon">icon-border-right</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-border-none"></span><span class="name form-icon">icon-border-none</span>
            </li>';
        $icons .= '<li class="btn-icon"><span class="icon-ellipsis"></span><span class="name form-icon">icon-ellipsis</span></li>';
        $icons .= '</ul>';
        return $icons;
    }
}