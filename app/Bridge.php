<?php
define('_DIR_ROOT', __DIR__);
//set lai gio VN
date_default_timezone_set('Asia/Ho_Chi_Minh');


//Handle http root
// if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
//     $web_root = 'https://' . $_SERVER['HTTP_HOST'];
// } else {
//     $web_root = 'http://' . $_SERVER['HTTP_HOST'];
// }
// $folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(str_replace('\\', '/', _DIR_ROOT)));
// $web_root .= $folder;
// define('_WEB_ROOT', $web_root);

//session init;
require_once './app/core/Session.php';
require_once './app/core/Cookie.php';
Session::init();

// Load thu vien
require 'vendor/autoload.php';


//AutoloadFile config 
$directoryConfigs = './configs';
if (is_dir($directoryConfigs)) {
    $files = scandir($directoryConfigs);
    foreach ($files as $file) {
        if (is_file($directoryConfigs . '/' . $file)) {
            require_once($directoryConfigs . '/' . $file);
        }
    }
}

// Load service provider class
require_once './app/core/dataShare/ServiceProvider.php';
require_once './app/core/dataShare/ViewShare.php'; //Load view Share

//Middleware
require_once './app/core/Middlewares.php';
require_once './app/middlewares/JWT.php';

//Route
require_once './app/core/Route.php';

//Check valid and connect database
if (!empty($config['database'])) {
    $dbConfig = array_filter($config['database']);
    if (!empty($dbConfig)) {
        require_once './app/core/database/Connection.php';
        require_once './app/core/database/QueryBuilder.php';
        require_once './app/core/database/Database.php';
        require_once './app/core/database/DBShare.php';
    }
}


require_once './app/core/App.php'; //Load App
require_once './app/core/database/BaseModel.php'; // Load basemodel
require_once './app/core/Controller.php'; // Load controller
require_once './app/core/Request.php'; // Load Request
require_once './app/core/Response.php'; // Load Response



//AutoloadFile utils
$directoryUtils = './utils';
if (is_dir($directoryUtils)) {
    $files = scandir($directoryUtils);
    foreach ($files as $file) {
        if (is_file($directoryUtils . '/' . $file)) {
            require_once($directoryUtils . '/' . $file);
        }
    }
}
