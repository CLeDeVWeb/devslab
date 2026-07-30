<?php

declare(strict_types=1);

namespace DevLab\Core;



final class Autoloader
{
	/**
	 * Namespace racine.
	 */
	private const ROOT_NAMESPACE = 'DevLab\\';

	/**
	 * Enregistre l'autoloader.
	 */
	public static function register(): void
	{
		spl_autoload_register([self::class, 'load']);
	}

	/**
	 * Charge automatiquement une classe.
	 */
	private static function load(string $class): void
	{
		// Ignore les namespaces externes
		if (!str_starts_with($class, self::ROOT_NAMESPACE)) {
			return;
		}

		
		$relative = substr($class, strlen(self::ROOT_NAMESPACE));

		
		$relative = str_replace('\\', DIRECTORY_SEPARATOR, $relative);

		// _src/Core/Database.class.php
		$file = ROOT_DIR. DIRECTORY_SEPARATOR. '_src'. DIRECTORY_SEPARATOR. $relative. '.php';

		if (is_file($file)) {
			require_once $file;
		}
	}
}