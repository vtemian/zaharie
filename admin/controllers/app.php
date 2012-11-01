<?php
	include_once Config.'main.php';

	include_once Lib.'mvc.php';
	include_once Lib.'db.php';

	abstract class AppController extends Controller {
		/// {array}
		public $configuration;

		/// {MySqlConnection}
		public $db;

		public $musntBeAuthenticated = false;
		public $mustBeAuthenticated = false;

		public $isAuthenticated = false;
		public $user = null;

		public function __construct($configuration) {
			parent::__construct();

			$this->appName = 'admin';
			
			$this->viewsPath = App.'views/';

			$this->configuration = $configuration;
		}

		protected function onInitiate() {
			parent::onInitiate();

			// Database
			$this->db = new MySqlConnection($this->configuration['db']['host'], $this->configuration['db']['user'], $this->configuration['db']['password'], $this->configuration['db']['database']);
			$this->db->open();
		}

		protected function onActionExecuting($context) {
			parent::onActionExecuting($context);

			// Check authentication
			$this->isAuthenticated = $this->isAuthenticated();

			if ($this->mustBeAuthenticated === true && !$this->isAuthenticated) {
				$context['result'] = $this->redirect('login.php');
			}
			else if ($this->musntBeAuthenticated === true && $this->isAuthenticated) {
				$context['result'] = $this->redirect('index.php');
			}

			// Retrieve user information
			if ($this->isAuthenticated) {
				$this->user = $this->getAuthenticatedUser();
			}
		}

		private function isAuthenticated() {
			return isset($this->session['authentication']);
		}

		private function getAuthenticatedUser() {
			return $this->db->one('SELECT * FROM Admins WHERE ID = @id', array('id' => $this->session['authentication']['user']));
		}

		protected function setAuthenticatedUser($id) {
			$this->session['authentication'] = array(
				'user' => $id
			);
		}
	}
?>