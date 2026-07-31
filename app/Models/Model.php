<?php
declare(strict_types=1);

namespace DevLab\Models;

use DevLab\Core\DB;

abstract class Model
{
	protected const DATABASE = 'DEVLAB';
	protected const TABLE_NAME = '';

	protected static function db(): DB
	{
		return DB::connect();
	}
}