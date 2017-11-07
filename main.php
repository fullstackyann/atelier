<?php
use mf\router\Router;

// Require autoload
require_once ("vendor/autoload.php");
require_once ("app/src/mf/utils/ClassLoader.php");

$loader = new mf\utils\ClassLoader('app/src');
$loader->register();
// initialisation connection
$config = parse_ini_file('conf/config.ini');
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();

// Définition des routes
$router = new Router();
$router->addRoute('home','/home/','\presentapp\control\PresentController', 'viewPresent');
$router->addRoute('signup','/signup/','\presentapp\control\PresentController', 'viewSignUp');
$router->addRoute('login','/form/','\presentapp\control\PresentController', 'viewLogin');
$router->addRoute('check_login','/form/','\presentapp\control\PresentController', 'check_login');
$router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('check_signup',   '/check_signup/','\presentapp\control\PresentController','checkSignup', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->run();