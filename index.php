<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/models/Customers.php';
require __DIR__ . '/app/controllers/CustomerController.php';

require __DIR__ . '/app/models/Subscriptions.php';
require __DIR__ . '/app/controllers/SubscriptionController.php';

require __DIR__ . '/app/models/Pets.php';
require __DIR__ . '/app/controllers/PetController.php';

require __DIR__ . '/app/models/SubscriptionPet.php';
require __DIR__ . '/app/controllers/SubscriptionPetController.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
         'db' => [
            'driver' => 'mysql',
            'host' => '192.168.16.3',
            'database' => 'teste_barkyn',
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

$app->get('/customer', '\App\Controllers\CustomerController:index');
$app->post('/customer', '\App\Controllers\CustomerController:add');
$app->put('/customer', '\App\Controllers\CustomerController:updateName');

$app->get('/subscription', '\App\Controllers\SubscriptionController:index');
$app->post('/subscription', '\App\Controllers\SubscriptionController:add');
$app->get('/subscription/searchByCustomer', '\App\Controllers\SubscriptionController:searchByCustomer');
$app->put('/subscription/updateNextOrder', '\App\Controllers\SubscriptionController:updateNextOrder');

$app->get('/pet', '\App\Controllers\PetController:index');
$app->post('/pet', '\App\Controllers\PetController:add');

$app->get('/subscription_pet', '\App\Controllers\SubscriptionPetController:index');
$app->post('/subscription_pet', '\App\Controllers\SubscriptionPetController:add');
$app->delete('/subscription_pet', '\App\Controllers\SubscriptionPetController:delete');

// Run app
$app->run();