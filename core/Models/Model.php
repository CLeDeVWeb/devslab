<?php
abstract class Model
{
	protected const DATABASE = 'DEVLAB';
	protected const TABLE_NAME = '';

	protected static function db(): DB
	{
		return DB::connect();
	}
}