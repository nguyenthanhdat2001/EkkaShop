<?php
class App
{
    // http://ekkashoe.shop/ecommerce_php_5_1/Home/Default/1/2/3
    protected $controller = 'Home';
    protected $action = 'Default';
    protected $params = [];
    protected $__routes;
    protected $__DBShare;

    static public $app;

    public function __construct()
    {
        try {
            self::$app = $this;

            // Init DBShare
            if (class_exists('DBShare')) {
                $dbShareObject = new DBShare;
                $this->__DBShare = $dbShareObject->db;
            }

            //Get url
            $url = $this->handleUrl();
	

            //Handle route
            $this->__routes = new Route();
            $url = $this->__routes->handleRoute($url);

            //App middlewares
            $this->handleRouteMiddleware($this->__routes->getKeyRoute(), $this->__DBShare);        //Gan key cua route va xu ly
            $this->handleGlobalMiddleware($this->__DBShare);  //check full app

            //App service provider
            $this->handleAppServiceProvider($this->__DBShare);

            // var_dump($url);
            //Handle có file không
            $urlCheck = '';
            if (!empty($url)) {
                foreach ($url as $key => $item) {
                    //Lấy ra url để kiểm tra 
                    $urlCheck .= $item . '/';
                    $fileCheck = rtrim($urlCheck, '/');
                    //tạo thành 1 mảng
                    $fileArr = explode('/', $fileCheck);
                    // Viết hoa phần cuối của URL 
                    $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                    $fileCheck = implode('/', $fileArr);

                    // Nếu đoạn URL trước đó không trống, loại bỏ nó
                    if (!empty($url[$key - 1])) {
                        unset($url[$key - 1]);
                    }

                    if (file_exists('./app/controllers/' . $fileCheck . '.php')) {
                        $urlCheck = $fileCheck;
                        break;
                    }
                }
                $url = array_values($url);
            }

            //Nếu urlCheck bằng null thì sẽ là trang home
            if (empty($urlCheck)) {
                $urlCheck = $this->controller;
            }


            //Handle controller
            if (empty($url)) {
                $this->controller = $this->controller;
            } else {
                if (!empty($url[0]) && file_exists('./app/controllers/' . $urlCheck . '.php')) {
                    $this->controller = $url[0];
                    unset($url[0]);
                } else {
                    return $this->loadError('notFound');
                }
            }

            require_once './app/controllers/' . $urlCheck . '.php';
            $controllerInstance = new $this->controller();

            //Share db cho controller
            if (!empty($this->__DBShare)) {
                $controllerInstance->db = $this->__DBShare;
            }


            //handle actions
            if (!empty($url[1]) && method_exists($controllerInstance, $url[1])) {
                $this->action = $url[1];
                unset($url[1]);
            }

            //handle params
            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$controllerInstance, $this->action], $this->params);
        } catch (\Throwable $e) {
            $mess = $e->getMessage();
            $line = $e->getFile();
            $file = $e->getLine();
            App::$app->loadError('database', ['message' => $mess, 'line' => $line, 'file' => $file]);
            die();
        }
    }

    //handle url
    protected function handleUrl()
    {
        if (isset($_GET['url'])) {
           
            return explode('/', filter_var(trim($_GET['url'], '/')));
        }
    }

    //Handle error
    public function loadError($nameError, $data = [])
    {
        extract($data);
        require_once "./app/errors/$nameError.php";
    }

    //Handle routeMiddleware
    public function handleRouteMiddleware($routeKey, $dbShare)
    {
        global $config;
        $routeKey = trim($routeKey);
        if (!empty($config['app']['routeMiddleware'])) {
            $routeMiddlewareArr = $config['app']['routeMiddleware'];
            foreach ($routeMiddlewareArr as $key => $middlewareItem) {

                //Kiem tra file middleware co ton tai khong roi import 
                if ($routeKey == trim($key) && file_exists('app/middlewares/' . $middlewareItem . '.php')) {
                    require_once 'app/middlewares/' . $middlewareItem . '.php';

                    if (class_exists($middlewareItem)) {
                        $middlewareObject = new $middlewareItem();
                        if (!empty($dbShare)) {
                            $middlewareObject->db = $dbShare;
                        }
                        $middlewareObject->handle();
                    }
                }
            }
        }
    }

    //Handle globalMiddleware
    public function handleGlobalMiddleware($dbShare)
    {
        global $config;
        if (!empty($config['app']['globalMiddleware'])) {
            $globalMiddlewareArr = $config['app']['globalMiddleware'];
            foreach ($globalMiddlewareArr as $middlewareItem) {

                //Kiem tra file middleware co ton tai khong roi import 
                if (file_exists('app/middlewares/' . $middlewareItem . '.php')) {
                    require_once 'app/middlewares/' . $middlewareItem . '.php';

                    if (class_exists($middlewareItem)) {
                        $middlewareObject = new $middlewareItem();
                        if (!empty($dbShare)) {
                            $middlewareObject->db = $dbShare;
                        }
                        $middlewareObject->handle();
                    }
                }
            }
        }
    }

    //Handle AppServiceProvider
    public function handleAppServiceProvider($dbShare)
    {
        global $config;

        if (!empty($config['app']['boot'])) {
            $serviceProviderArr = $config['app']['boot'];

            foreach ($serviceProviderArr as $serviceName) {

                //Kiem tra file middleware co ton tai khong roi import 
                if (file_exists('app/core/dataShare/' . $serviceName . '.php')) {
                    require_once 'app/core/dataShare/' . $serviceName . '.php';

                    if (class_exists($serviceName)) {
                        $serviceProviderObject = new $serviceName();
                        if (!empty($dbShare)) {
                            $serviceProviderObject->db = $dbShare;
                        }
                        $serviceProviderObject->boot();
                    }
                }
            }
        }
    }
}
