<?php

declare(strict_types=1);

namespace DevLab\Core;

/**
 * --------------------------------------------------------------------------
 * DevLab Framework
 * --------------------------------------------------------------------------
 * Autoloader PSR-4 simplifié
 *
 * Namespace :
 *      DevLab\Core\Database
 *
 * devient :
 *      _src/Core/Database.class.php
 * --------------------------------------------------------------------------
 */
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
		$file = DL_ROOT. DIRECTORY_SEPARATOR. '_src'. DIRECTORY_SEPARATOR. $relative. '.php';

		if (is_file($file)) {
			require_once $file;
		}
	}
}