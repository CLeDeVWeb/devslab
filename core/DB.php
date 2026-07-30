<?php

declare(strict_types=1);

final class DB {

	private static ?PDO $oPDO = null;
	private static bool $activeLog = false;

	
	private function __construct(){}

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

	/**
	 * Exécute une requête SELECT.
	 *
	 * @return array
	 */
	public static function select( string $sSQL, array $aParams = [], ?string $sClass = null ): array {

		$oStatement = self::prepareAndExecute($sSQL, $aParams);

		if ($sClass !== null) {
			$oStatement->setFetchMode(PDO::FETCH_CLASS, $sClass);
		}

		return $oStatement->fetchAll();
	}

	

	/**
	 * Retourne un seul enregistrement.
	 */
	public static function selectOne( string $sSQL, array $aParams = [], ?string $sClass = null ): object|null {

		 $oStatement = self::prepareAndExecute($sSQL, $aParams);

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
	public static function execute( string $sSQL, array $aParams = [] ): int {

		return self::prepareAndExecute($sSQL, $aParams)->rowCount();

	}

	/**
	 * @return int Identifiant créé
	 */
	public static function insert( string $sSQL, array $aParams = [] ): int {
		self::prepareAndExecute($sSQL, $aParams);
		return self::lastInsertId();
	}


	public static function update(string $sSQL,array $aParams = []): int {
		$oStmt = self::prepareAndExecute($sSQL, $aParams);
	 	return $oStmt->rowCount();
	}

	
	public static function delete(string $sSQL,array $aParams = []): int {
		$oStmt = self::prepareAndExecute($sSQL, $aParams);
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
	 * @param array  $aParams Paramètres de la requête
	 *
	 * @throws PDOException
	 */
	private static function prepareAndExecute( string $sSQL, array $aParams = [] ): PDOStatement {
		try {

			$oStatement = self::connect()->prepare($sSQL);

			$oStatement->execute($aParams);

			if (self::$activeLog) {

				Logger::debug(
					sprintf(
						"SQL :\n%s\n\nPARAMS :\n%s",
						$sSQL,
						json_encode( $aParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE )
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
						json_encode($aParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
				),
				Logger::TYPE_SQL
			);

			throw $e;
		}
	}
}