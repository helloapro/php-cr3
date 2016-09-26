<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Stylist.php';
    require_once __DIR__.'/../src/Client.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/add_stylist", function() use ($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app->redirect('/');
    });

    $app->patch("/edit_stylist/{stylist_id}", function($stylist_id) use ($app) {
        $stylist = Stylist::getStylistById($stylist_id);
        $new_name = $_POST['stylist_name'];
        $stylist->setName($new_name);
        return $app->redirect('/');
    });

    $app->delete("/delete_stylist/{stylist_id}", function($stylist_id) use ($app) {
        $stylist = Stylist::getStylistById($stylist_id);
        $stylist->deleteStylist();
        return $app->redirect('/');
    });

    $app->post("/add_client", function() use ($app) {
        $client = new Client($_POST['client_name'], $_POST['stylist_id']);
        $client->save();
        return $app->redirect('/');
    });

    $app->get("/client_list/{stylist_id}", function($stylist_id) use ($app) {
        $filtered_clients = Stylist::find($stylist_name);
        return $app['twig']->render('clients-list.html.twig', array('clients' => $filtered_clients));
    });

    return $app;
?>
