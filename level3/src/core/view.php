<?php

class View {

    public static function render($url, $data = null) {
        switch ($url) {
            case 'admin.php':
                require SRC_PATH . 'view/admin.php';
                break;
            default:
                require SRC_PATH . 'view/main.php';
        }

    }
}