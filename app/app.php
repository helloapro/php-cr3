<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Stylist.php';
    require_once __DIR__.'/../src/Client.php';

    $server = 'mysql:host=localhost;dbname=hair_salon';
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

    $app->patch("/edit_stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['stylist_name']);
        return $app->redirect('/');
    });

    $app->delete("/delete_stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->deleteStylist();
        return $app->redirect('/');
    });

    $app->get("/delete_all_stylists", function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app->redirect('/');
    });

    $app->post("/add_client", function() use ($app) {
        $client = new Client($_POST['client_name'], $_POST['stylist_id']);
        $client->save();
        return $app->redirect('/');
    });

    $app->get("/client_list/{id}", function($id) use ($app) {
        $found_stylist = Stylist::find($id);
        return $app['twig']->render('clients-list.html.twig', array('clients' => $found_stylist->getClients()));
    });

    $app->patch("/edit_client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->update($_POST['client_name']);
        return $app->redirect('/');
    });

    $app->delete("/delete_client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->deleteClient();
        return $app->redirect('/');
    });

    return $app;
?>
