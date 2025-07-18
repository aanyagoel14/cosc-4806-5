<?php
class App {
    protected $controller = 'login';
    protected $method = 'index';
    protected $special_url = ['apply', 'reports'];
    protected $params = [];

    public function __construct() {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
            $this->controller = 'home';
        } 

        $url = $this->parseUrl();

        if (isset($url[1])) {
            $controller_file = 'app/controllers/' . strtolower($url[1]) . '.php';

            if (file_exists($controller_file)) {
                $this->controller = strtolower($url[1]);

                if ($this->controller === 'reports') {
                    $this->method = 'index';
                    if (isset($url[2])) {
                        $this->params = [$url[2]];
                    }
                }

                $_SESSION['controller'] = $this->controller;

                if (in_array($this->controller, $this->special_url)) { 
                    $this->method = 'index';
                }

                unset($url[1]);
            } else {
                header('Location: /home');
                die;
            }
        } else {
            header('Location: /home');
            die;
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $controller_class = ucfirst($this->controller);

        if (!class_exists($controller_class)) {
            header('Location: /home');
            die;
        }

        $this->controller = new $controller_class;

        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                $_SESSION['method'] = $this->method;
                unset($url[2]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);		
    }

    public function parseUrl() {
        $u = "{$_SERVER['REQUEST_URI']}";
        $url = explode('/', filter_var(rtrim($u, '/'), FILTER_SANITIZE_URL));
        unset($url[0]);
        return $url;
    }
}