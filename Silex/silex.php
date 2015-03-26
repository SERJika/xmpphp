<?php
require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();
$app->get('/hello/{name}', function ($name) use ($app) {
    echo "TEst";
    echo 1+2;
    return 'Hello '.$app->escape($name);
});
$app->get('/', function () use ($app) {
    return 'Main ';
});
$app->get('/news/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM news WHERE id = :id";
    
    return 'Hello '.$app->escape($id);
});
$app->run();



// -----------------




$app['debug'] = true // отладка

// ------------------

<?php
require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array(    // регистрируем шаблонизатор twig
    'twig.path' => __DIR__.'/../views',
));
$app['debug'] = true;
$app->get('/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});
$app->get('/', function () use ($app) {
    return 'Main ';
});
$app->get('/news/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM news WHERE id = :id";
    return 'Hello '.$app->escape($id);
});
$app->run();