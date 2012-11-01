<?php
	class StudentiController extends AppController {
		public $mustBeAuthenticated = true;

		public function index() {
			$users = $this->db->query('SELECT * FROM Users');

			$model = array_map(function ($user) {
				return array(
					'id' => $user['ID'],
					'username' => $user['Username']
				);
			}, $users);

			return $this->view($model);
		}

		public function add() {
			return $this->view();
		}

		public function add_onPost($form) {
			$model = array(
				'username' => trim($form['username']),
				'password' => trim($form['password'])
			);

			if (empty($model['username'])) {
				$this->flash('CNP-ul este necesar', true);
			}
			else if (empty($model['password'])) {
				$this->flash('Parola este necesara', true);
			}
			else {
				$affected = $this->db->execute('INSERT INTO Users (Username, Password) VALUES (@username, @password)', array(
					'username' => $model['username'],
					'password' => $model['password']
				));

				$this->flash('Studentul a fost adaugat');

				return $this->redirect('studenti.php');
			}

			return $this->view();
		}

		public function delete($user) {
			$affected = $this->db->execute('DELETE FROM Users WHERE ID = @user', array('user' => $user));

			if ($affected > 0) {
				$this->flash('Studentul a fost sters !');
			}

			return $this->redirect('studenti.php');
		}
	}
?>