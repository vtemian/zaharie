<?php
	class NoteController extends AppController {
		public $mustBeAuthenticated = true;

		protected function onActionExecuting($context) {
			parent::onActionExecuting($context);

			$user = $context['params']['user'];

			$this->selectedUser = $this->db->one('SELECT * FROM Users WHERE ID = @id', array('id' => $user));

			if (!$this->selectedUser) {
				return $context['result'] = $this->redirect('studenti.php');
			}

			$this->data['selectedUser'] = array(
				'id' => $this->selectedUser['ID'],
				'username' => $this->selectedUser['Username']
			);
		}

		public function index() {
			$note = $this->db->query('SELECT * FROM Note WHERE UserID = @user.id', array('user.id' => $this->selectedUser['ID']));

			$model = array_map(function ($nota) {
				return array(
					'id' => $nota['ID'],
					'nota' => $nota['Nota'],
					'data' => $nota['Data'],
					'descriere' => $nota['Descriere']
				);
			}, $note);

			return $this->view($model);
		}

		public function add() {
			return $this->view();
		}

		public function add_onPost($form) {
			$model = array(
				'nota' => (int)(trim($form['nota'])),
				'data' => trim($form['data']),
				'descriere' => trim($form['descriere'])
			);

			if (empty($model['nota'])) {
				$this->flash('Nota este necesara', true);
			}
			else {
				$affected = $this->db->execute('INSERT INTO Note (UserID, Nota, Data, Descriere) VALUES (@user.id, @nota, @data, @descriere)', array(
					'user.id' => $this->selectedUser['ID'],

					'nota' => $model['nota'],
					'data' => $model['data'] ?: null,
					'descriere' => $model['descriere'] ?: null
				));

				$this->flash('Nota a fost adaugata');

				return $this->redirect('note.php?user='.$this->selectedUser['ID']);
			}

			return $this->view();
		}

		public function delete($user, $nota) {
			$affected = $this->db->execute('DELETE FROM Note WHERE UserID = @user.id AND ID = @nota', array('user.id' => $this->selectedUser['ID'], 'nota' => $nota));

			if ($affected > 0) {
				$this->flash('Nota a fost stearsa !');
			}

			return $this->redirect('note.php?user='.$this->selectedUser['ID']);
		}
	}
?>