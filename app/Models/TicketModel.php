<?php

declare(strict_types=1);

namespace DevLab\Models;

use DevLab\Core\DB;
use DevLab\Entities\Ticket;

final class TicketModel
{
	
	protected const DATABASE = 'DEVLAB';
	protected const DEFAULT_NUM_RESULT_BY_PAGE = 20;
	protected const TABLE_NAME = 'TICKET';

	/**
	 * Charge tous les tickets.
	 */
	public static function load(): array {
		$sSQL = " SELECT * FROM " . self::TABLE_NAME . " ORDER BY id ";
		// var_dump(class_exists(Ticket::class));
		// var_dump(Ticket::class);die;
		return DB::select( $sSQL, []);
	}

	/**
	 * Charge un ticket.
	 */
	public static function loadById(int $id): ?Ticket {
		$sSQL = "
			SELECT *
			FROM " . self::TABLE_NAME . "
			WHERE id = :id
		";

		return DB::selectOne($sSQL,['id' => $id], Ticket::class );
	}
}