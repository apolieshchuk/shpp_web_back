<?php

class Router {

    public static function run() {
        $request = parse_url($_SERVER['REQUEST_URI']);
        $path = explode('/', $request['path']);

        // default values
        $route = $path[1];
        $action = (count($path) < 3
                || $path[2] === '') ? 'index' : $path[2];

        // get component
        switch ($route) {
            case 'admin':
                Auth::isAuth();
                switch ($action) {
                    case 'index':
                        break;
                    case 'addBook':
                        // check method
                        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                            Server::errCode(405);
                        }
                        $action = 'addBook';
                        break;
                    case 'deleteBook':
                        $action = 'deleteBook';
                        break;
                    default:
                        Server::errCode(404);
                }
                break;
            case 'books':
                switch ($action) {
                    case 'index':
                        Server::redirect('/');
                        break;
                    case 'book':
                        $action = 'getBook';
                        break;
                    case 'click':
                        $action = 'clickBook';
                        break;
                    case 'search':
                        break;
                    default:
                        Server::errCode(404);
                }
                break;
            case '':
                if(!isset($_GET['offset'])){
                    $_GET['offset'] = DEFAULT_OFFSET;
                }
                $route = 'books';
                break;
            default:
                Server::errCode(404);
        }


        // bind model
        Router::bindModel($route);

        // bind controller
        $controller = Router::bindController($route);

        // do action
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Server::errCode(404);
        }
    }


    private static function bindController ($route) {
        $controller_name = 'Controller_'.strtolower($route);
        $controller_file = $controller_name .'.php';
        $controller_path = SRC_PATH . 'controller/'. $controller_file;
        require $controller_path;
        return new $controller_name;
    }

    private static function bindModel ($route) {
        $model_name = 'Model_'.strtolower($route);
        $model_file = $model_name .'.php';
        $model_path = SRC_PATH . 'model/'. $model_file;
        if(file_exists($model_path)) {
            require $model_path;
        }
    }

}