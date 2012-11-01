<?php
	include_once 'config/paths.php';

	include_once App.'controllers/app.php';
	include_once App.'controllers/login.php';

	$controller = new LoginController($configuration);

	$controller->dispatch('index');
?>