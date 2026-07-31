<?php

declare(strict_types=1);

namespace DevLab\Core;

final class Autoloader
{
	private const ROOT_NAMESPACE = 'DevLab\\';

	public static function register(): void {

		spl_autoload_register([self::class, 'load']);
		
	}

	private static function load(string $class): void
	{
		if (!str_starts_with($class, self::ROOT_NAMESPACE)) {
			return;
		}

		$relative = substr($class, strlen(self::ROOT_NAMESPACE));

		$parts = explode('\\', $relative);

		$root = array_shift($parts);

		$map = [
			'Controllers' => ROOT_DIR . '/app/Controllers',
			'Entities' => ROOT_DIR . '/app/Entities',
			'Models'      => ROOT_DIR . '/app/Models',
			'Services'    => ROOT_DIR . '/app/Services',
			'Views'       => ROOT_DIR . '/app/Views',
			'Core'        => ROOT_DIR . '/core',
		];

		if (!isset($map[$root])) {
			return;
		}

		$file = $map[$root];

		if (!empty($parts)) {
			$file .= '/' . implode('/', $parts);
		}

		$file .= '.php';

		if (is_file($file)) {
			require_once $file;
		}
	}
}