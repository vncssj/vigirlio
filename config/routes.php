<?php


use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;


Router::defaultRouteClass('DashedRoute');

if (!file_exists(TMP.'installed.txt')) 
{ 
	$connection = ConnectionManager::get('default');	
	$installed = true;
	try{
		@$connection->connect();
	}
	catch (Exception $e) {
		/* echo 'Caught exception: ',  $e->getMessage(), "\n"; */
		$installed = false;
	}
	
/* 	if($installed)
	{
		$tbl = TableRegistry::get("general_settings");
		$data = $tbl->find();
	} */
	
	if($installed == false)	
	{
		Router::scope('/', function (RouteBuilder $routes) {
			$routes->connect('/*', ['controller' => 'Installer', 'action' => 'index']);
			/* $routes->connect('/', ['controller' => 'Installer', 'action' => 'index']); */
			$routes->fallbacks('DashedRoute');
		});
	}
}



Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    // $routes->connect('/', ['controller' => 'dashboard', 'action' => 'index']);
    $routes->connect('/', ['controller' => 'Users', 'action' => 'index']);
	
    // $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'index2']);	
    // $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
   
   

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    // $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
