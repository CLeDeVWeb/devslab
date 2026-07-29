<?php

final class Dispatcher
{
	public function dispatch(string $class, string $method): mixed
	{
		if (!class_exists($class)) {
			throw new \RuntimeException(
				sprintf('Controller "%s" introuvable.', $class)
			);
		}

		$controller = new $class();

		if (!method_exists($controller, $method)) {
			throw new \RuntimeException(
				sprintf(
					'Méthode "%s::%s()" introuvable.',
					$class,
					$method
				)
			);
		}

		return $controller->$method();
	}
}