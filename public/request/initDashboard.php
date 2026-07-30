<?php

declare(strict_types=1);

use DevLab\Controllers\DashboardController;

require_once dirname(__DIR__, 2) . '/init.php';

header('Content-Type: application/json; charset=UTF-8');

try {

	$oController = new DashboardController();

	echo json_encode(
		$oController->init(),
		JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
	);

} catch (Throwable $e) {

	http_response_code(500);

	echo json_encode([
		'success' => false,
		'message' => $e->getMessage()
	], JSON_UNESCAPED_UNICODE);

}