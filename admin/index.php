<?php
	include_once 'config/paths.php';

	include_once App.'controllers/app.php';
	include_once App.'controllers/home.php';

	$controller = new HomeController($configuration);

	$controller->dispatch('index');
?>