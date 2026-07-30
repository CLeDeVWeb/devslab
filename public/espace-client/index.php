<?php

declare(strict_types=1);

require_once __DIR__ . '/../../init.php';

// use DevLab\Core\Application;

// $app = new Application();

// $app->run();
?>

<!DOCTYPE html>
<html lang="fr">

<head>

	<meta charset="UTF-8">

	<title>Espace Client</title>

	<link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/devlab.css">

</head>

<body>

	<main class="dl-container">

		<section class="dl-section">

			<?php require_once './dashboard.php'; ?>

		</section>

	</main>

</body>
<script type="module" src="/assets/js/dashboard/mainDashboard.js"></script>

</html>