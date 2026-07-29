<?php

declare(strict_types=1);

require_once __DIR__.'/../init.php';

$app = new DevLab\Core\Application();

$app->run();
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>DevLab</title>

		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		<link rel="stylesheet" href="assets/css/devlab.css">
	</head>

	<body>

	<header class="py-4 border-bottom">
		<div class="container">
			<section class="dl-intro">
				<div class="dl-container">
					<div class="dl-intro-content">

						<h1 class="dl-intro-title"> DevLab </h1>

						<p class="dl-intro-subtitle"> Construire. Comprendre. Réutiliser. </p>

						<p class="dl-intro-description">
							Un laboratoire de développement où chaque projet devient
							une brique réutilisable, documentée et maintenable.
						</p>

						<div class="dl-intro-actions">

							<a href="#projects" class="dl-btn dl-btn-primary">
								Explorer les projets
							</a>

							<a href="#" class="dl-btn dl-btn-outline">
								GitHub
							</a>

						</div>

					</div>

				</div>

				<div>
					<span class="badge text-bg-secondary">v1.0.0</span>
				</div>
			</section>

		</div>
	</header>


	<main class="container py-5">
		<section id="projects" class="dl-section">

			<div class="dl-container">

				<header class="dl-section-header">

					<h2 class="dl-section-title"> Mes laboratoires </h2>

					<p class="dl-section-description">
						Chaque projet est conçu comme une brique indépendante,
						documentée et réutilisable.
					</p>

				</header>

				<div class="dl-grid dl-grid-3"">
					<article class="dl-project-card">
						<header class="dl-card-header">
							<div class="dl-card-icon"> 👥 </div>

							<h3 class="dl-card-title"> Espace Client </h3>

						</header>

						<div class="dl-card-body">

							<p>
								Gestion complète d'un espace client responsive avec
								formulaires, planning, notifications et suivi.
							</p>

						</div>


						<footer class="dl-project-card-footer">

							<div class="dl-project-card-tags">

								<span class="dl-tag">PHP</span>
								<span class="dl-tag">JavaScript</span>
								<span class="dl-tag">MySQL</span>

							</div>

							<div class="dl-project-card-actions">

								<a href="/espace-client/" class="dl-btn dl-btn-primary"> Ouvrir </a>

							</div>


						</footer>

					</article>

					<article class="dl-project-card">
						<header class="dl-card-header">
							<div class="dl-card-icon"> 🎫 </div>

							<h3 class="dl-card-title"> Ticket Manager </h3>

						</header>

						<div class="dl-card-body">

							<p>
								Gestion des tickets, workflow, suivi des interventions
								et historique des actions.
							</p>

						</div>

						<footer class="dl-card-footer">
							<div class="dl-tags">

								<span class="dl-tag">PHP</span>
								<span class="dl-tag">SQL</span>
								<span class="dl-tag">Bootstrap</span>

							</div>

							<a href="#" class="dl-btn dl-btn-primary"> 	Découvrir </a>

						</footer>

					</article>

					<article class="dl-project-card">

						<header class="dl-card-header">
						
							<div class="dl-card-icon">
								 <i class="fa-solid fa-calendar-days fa-2x mb-3"></i>
							</div>
							<h3 class="dl-card-title""> Planning</h3>
						</header>

						<div class="dl-card-body">
							<p>	Calendriers et planification.</p>

						</div>
					
						<footer class="dl-project-card-footer">
						<div class="dl-project-card-tags">

							<span class="dl-tag">PHP</span>
							<span class="dl-tag">JavaScript</span>
							<span class="dl-tag">Bootstrap</span>
							<span class="dl-tag">MySQL</span>

						</div>

						<div class="dl-project-card-actions">

							<a href="#" class="dl-btn dl-btn-primary"> Ouvrir </a>

						</div>

						</footer>

					</article>

				</div>

				<div class="col-md-6 col-xl-4">

					<div class="dl-card">
						<div class="dl-card-header">
							<h3>Outils</h3>
						</div>

						<div class="dl-card-body">

							<i class="fa-solid fa-screwdriver-wrench fa-2x mb-3"></i>

							<p>Moulinettes et utilitaires.</p>
							
						</div>

						<div class="dl-card-footer">
							<a href="#" class="dl-btn dl-btn-primary">→ Découvrir</a>
						</div>

					</div>

				</div>

				<div class="col-md-6 col-xl-4">

					<div class="dl-card">
						<div class="dl-card-header">
							<h3>Sandbox</h3>
						</div>
						<div class="dl-card-body">

							<i class="fa-solid fa-flask fa-2x mb-3"></i>

							<p>Zone d'expérimentation.</p>
						</div>

						<div class="dl-card-footer">
							<a href="#" class="dl-btn dl-btn-primary">→ Découvrir</a>
						</div>

					</div>

				</div>

				<div class="col-md-6 col-xl-4">
					<div class="dl-card">
						<div class="dl-card-header">
							<h3>Documentation</h3>
						</div>

						<div class="dl-card-body">
							<i class="fa-solid fa-book fa-2x mb-3"></i>

							<p>Documentation technique.</p>
						</div>
						
						<div class="dl-card-footer">
							<a href="#" class="dl-btn dl-btn-primary">→ Découvrir</a>
						</div>
					</div>

				</div>

				</div>

			</div>

		</section>

	</main>


	<footer class="dl-footer border-top py-4">

		<div class="container text-center">

			<small>
				DevLab © 2026
			</small>

		</div>

	</footer>

	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="assets/js/config.js"></script>
	<script src="assets/js/plugins.js"></script>
	<!-- <script src="assets/js/app.js"></script> -->
	<script type="module" src="assets/js/app.js"></script>	
	</body>
</html>