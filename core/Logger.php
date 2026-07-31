<?php

declare(strict_types=1);

namespace DevLab\Core;

final class Logger{
	/**
	 * Fichier de log.
	 */
	private const LOG_FILE = ROOT_DIR . '/logs/devlab.log';
	private const SQL_FILE = ROOT_DIR . '/logs/sql.log';

	public const TYPE_APP = 1;
	public const TYPE_SQL = 2;

	/**
	 * Constructeur privé.
	 */
	private function __construct()
	{
	}

	/**
	 * DEBUG
	 */
	public static function debug(string $message, int $type = self::TYPE_APP): void {
		self::write('DEBUG', $message, $type);
	}


	public static function info(string $message, int $type = self::TYPE_APP): void {
		self::write('INFO', $message, $type);
	}


	public static function warning(string $message, int $type = self::TYPE_APP): void {
		self::write('WARNING', $message, $type);
	}


	public static function error(string $message, int $type = self::TYPE_APP): void {
		self::write('ERROR', $message, $type);
	}


	public static function critical(string $message, int $type = self::TYPE_APP): void {
		self::write('CRITICAL', $message, $type);
	}

	/**
	 * Ecrit une ligne dans le journal.
	 */
	private static function write(string $level, string $message, int $type): void {
		$logFile = match ($type) {
			self::TYPE_SQL => self::SQL_FILE,
			default        => self::LOG_FILE,
		};


		$line = sprintf( "[%s] %-8s %s%s", date('Y-m-d H:i:s'), $level, $message, PHP_EOL );

		file_put_contents( $logFile, $line, FILE_APPEND | LOCK_EX );
	}
}