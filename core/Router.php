<?php

declare(strict_types=1);

namespace DevLab\Core;

use DevLab\Http\Request;

final class Router
{
	/*==========================================================================
	* Propriétés
	*==========================================================================*/

	/**
	 * @var array<int, array<string,string>>
	 */
	private array $routes = [];

	/*==========================================================================
	* API publique
	*==========================================================================*/

	public function add(string $method, string $path, string $controller): self
	{
		$this->routes[] = [
			'method'     => strtoupper($method),
			'path'       => $path,
			'controller' => $controller,
		];

		return $this;
	}

	public function match(Request $request): ?array
	{
		foreach ($this->routes as $route) {

			if (
				$route['method'] === $request->getMethod()
				&& $route['path'] === $request->getPath()
			) {
				return $route;
			}
		}

		return null;
	}

	public function getRoutes(): array
	{
		return $this->routes;
	}
}