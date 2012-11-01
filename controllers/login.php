<?php
	class LoginController extends AppController {
		public $musntBeAuthenticated = true;

		public function index() {
			return $this->view();
		}

		public function index_onPost($form) {
			$found = $this->db->one('SELECT ID FROM Users WHERE Username = @username AND Password = @password', array('username' => $form['username'], 'password' => $form['password']));

			if (!$found) {
				$this->flash('Studentul nu exista', true);
			}
			else {
				$this->setAuthenticatedUser($found['ID']);

				return $this->redirect('index.php');
			}

			return $this->view();	
		}
	}
?>