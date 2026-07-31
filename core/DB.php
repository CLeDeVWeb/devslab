<?php

declare(strict_types=1);

namespace DevLab\Core;

use PDO;
use PDOException;
use PDOStatement;
// use Logger;

final class DB {

	private static ?PDO $oPDO = null;
	private static bool $activeLog = false;
	private const CONFIG_FILE = ROOT_DIR . '/config/database.php';
	
	private function __construct(){}

	/**
	 * Retourne la connexion PDO.
	 */
	private static function connect(): PDO	{
		if (self::$oPDO instanceof PDO) {
			return self::$oPDO;
		}

		$aConfig = require self::CONFIG_FILE;

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

	/**
	 * Exécute une requête SELECT.
	 *
	 * @return array
	 */
	public static function select( string $sSQL, array $params = [], ?string $sClass = null ): array {

		$oStatement = self::prepareAndExecute($sSQL, $params);

		if ($sClass !== null) {
			$oStatement->setFetchMode(PDO::FETCH_CLASS, $sClass);
		}

		return $oStatement->fetchAll();
	}

	

	/**
	 * Retourne un seul enregistrement.
	 */
	public static function selectOne( string $sSQL, array $params = [], ?string $sClass = null ): object|null {

		 $oStatement = self::prepareAndExecute($sSQL, $params);

		if ($sClass !== null) {
			$oStatement->setFetchMode(PDO::FETCH_CLASS, $sClass);
		}

		$oResult = $oStatement->fetch();

		return ($oResult === false) ? null : $oResult;
	}


	public static function setActiveLog(bool $active): void {
		self::$activeLog = $active;
	}

	/**
	 * Exécute une requête (INSERT / UPDATE / DELETE).
	 *
	 * @return int Nombre de lignes affectées
	 */
	public static function execute( string $sSQL, array $params = [] ): int {

		return self::prepareAndExecute($sSQL, $params)->rowCount();

	}

	/**
	 * @return int Identifiant créé
	 */
	public static function insert( string $sSQL, array $params = [] ): int {
		self::prepareAndExecute($sSQL, $params);
		return self::lastInsertId();
	}


	public static function update(string $sSQL,array $params = []): int {
		$oStmt = self::prepareAndExecute($sSQL, $params);
	 	return $oStmt->rowCount();
	}

	
	public static function delete(string $sSQL,array $params = []): int {
		$oStmt = self::prepareAndExecute($sSQL, $params);
	 	return $oStmt->rowCount();
	}

	/**
	 * Dernier identifiant inséré.
	 */
	public static function lastInsertId(): int	{
		return (int) self::connect()->lastInsertId();
	}

	/**
	 * Début de transaction.
	 */
	public static function beginTransaction(): bool {
		return self::connect()->beginTransaction();
	}

	/**
	 * Validation de transaction.
	 */
	public static function commit(): bool {
		return self::connect()->commit();
	}

	/**
	 * Annulation de transaction.
	 */
	public static function rollback(): bool {
		return self::connect()->rollBack();
	}

	/**
	 * Prépare et exécute une requête SQL.
	 *
	 * @param string $sSQL    Requête SQL
	 * @param array  $params Paramètres de la requête
	 *
	 * @throws PDOException
	 */
	private static function prepareAndExecute( string $sSQL, array $params = [] ): PDOStatement {
		try {

			$oStatement = self::connect()->prepare($sSQL);

			$oStatement->execute($params);

			if (self::$activeLog) {

				Logger::debug(
					sprintf(
						"SQL :\n%s\n\nPARAMS :\n%s",
						$sSQL,
						json_encode( $params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE )
					),
					Logger::TYPE_SQL
				);
			}

			return $oStatement;




		} catch (PDOException $e) {

			Logger::error(
				sprintf(
					  "[%s:%d]\n%s\n\nSQL :\n%s\n\nPARAMS :\n%s",
						basename($e->getFile()),
						$e->getLine(),
						$e->getMessage(),
						$sSQL,
						json_encode($params, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
				),
				Logger::TYPE_SQL
			);

			throw $e;
		}
	}
}