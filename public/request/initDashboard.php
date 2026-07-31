<?php

declare(strict_types=1);

use DevLab\Controllers\TicketController;


require_once dirname(__DIR__, 2) . '/init.php';

header('Content-Type: application/json; charset=UTF-8');

try {

	$oTicket = new TicketController;

	echo json_encode(
		$oTicket->load(),
		JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
	);

} catch (Throwable $e) {

	http_response_code(500);

	echo json_encode([
		'success' => false,
		'message' => $e->getMessage()
	], JSON_UNESCAPED_UNICODE);

}