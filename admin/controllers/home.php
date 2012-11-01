<?php
	class HomeController extends AppController {
		public $mustBeAuthenticated = true;

		public function index() {
			return $this->view();
		}
	}
?>