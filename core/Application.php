<?php
declare(strict_types=1);

namespace DevLab\Core;

use DevLab\Http\Request;
use DevLab\Core\Router;

final class Application
{
	public function run(): void
	{
		$request = Request::createFromGlobals();
		

		$router = new Router();

		$router->add('GET', '/', 'HomeController@index');
		$router->add('GET', '/espace-client/', 'ClientController@index');

		$route = $router->match($request);

		
		}
	}