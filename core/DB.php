<?php

declare(strict_types=1);

final class DB
{
	/**
	 * Instance PDO.
	 */
	private static ?PDO $oPDO = null;

	/**
	 * Constructeur privé.
	 */
	private function __construct()
	{
	}

	/**
	 * Retourne la connexion PDO.
	 */
	private static function connect(): PDO
	{
		if (self::$oPDO instanceof PDO) {
			return self::$oPDO;
		}

		$aConfig = require dirname(__DIR__) . '/config/database.php';

		$sDsn = sprintf(
			'mysql:host=%s;dbname=%s;charset=%s',
			$aConfig['host'],
			$aConfig['database'],
			$aConfig['charset']
		);

		self::$oPDO = new PDO(
			$sDsn,
			$aConfig['username'],
			$aConfig['password'],
			[
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
				PDO::ATTR_EMULATE_PREPARES   => false,
			]
		);

		return self::$oPDO;
	}
}	