<?php
	include_once 'config/paths.php';

	include_once App.'controllers/app.php';
	include_once App.'controllers/note.php';

	$controller = new NoteController($configuration);

	$controller->dispatch('delete', array('user' => $_GET['user'], 'nota' => $_GET['nota']));
?>