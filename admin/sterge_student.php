<?php
	include_once 'config/paths.php';

	include_once App.'controllers/app.php';
	include_once App.'controllers/studenti.php';

	$controller = new StudentiController($configuration);

	$controller->dispatch('delete', array('user' => $_GET['user']));
?>