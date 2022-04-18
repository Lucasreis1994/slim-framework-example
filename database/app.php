<?php
// session_start();
//autoload dependenciesrequire __DIR__ . '/../vendor/autoload.php';
//pass eloquent connection to slim settings object

require __DIR__.'/../vendor/autoload.php';
$app = new \Slim\App([
       'settings' => [
           'displayErrorDetails' => true,
            'db' => [
               'driver' => 'mysql',
               'host' => '172.22.0.3',
               'database' => 'teste_barkin',
               'username' => 'root',
               'password' => '123456',
               'charset' => 'utf8',
               'collation' => 'utf8_unicode_ci',
       ]
       ],
]);
//get all container items
$container = $app->getContainer();
//boot eloquent connection
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
//pass the connection to global container (created in previous article)
$container['db'] = function ($container) use ($capsule){
   return $capsule;
};
$container['CustomerController'] = function ($container) {
   return new \App\Controllers\CustomerController($container);
};
require __DIR__ . '/../app/routes.php';
?>