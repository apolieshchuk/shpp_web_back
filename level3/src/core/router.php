<?php

class Router {

    public static function run() {
        $component = 'books';
        $action = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // get component
        switch ($routes[1] ) {
            case 'admin':
                $component = 'admin';
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $action = 'addBook';
                }
                break;
            case 'auth':
                $component = 'auth';
                break;
            case 'books':
                if ($routes[2] == 'book') {
                    $action = 'getBook';
                    break;
                }
                Server::redirect(HOME_PAGE);
                break;
            case '':
                $component = 'books';
                break;
            default:
                Server::errCode(404);
        }

        // bind model
        Router::bindModel($component);

        // bind controller
        $controller = Router::bindController($component);

        // do action
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Server::errCode(404);
        }
    }

    private static function bindController ($component) {
        $controller_name = 'Controller_'.strtolower($component);
        $controller_file = $controller_name .'.php';
        $controller_path = SRC_PATH . 'controller/'. $controller_file;
        require $controller_path;
        return new $controller_name;
    }

    private static function bindModel ($component) {
        $model_name = 'Model_'.strtolower($component);
        $model_file = $model_name .'.php';
        $model_path = SRC_PATH . 'model/'. $model_file;
        if(file_exists($model_path)) {
            require $model_path;
        }
    }


}