<?php
	class HomeController extends AppController {
		public $mustBeAuthenticated = true;

		public function index() {
			$note = $this->db->query('SELECT * FROM Note WHERE UserID = @user.id ORDER BY Data DESC', array('user.id' => $this->user['ID']));

			$model = array_map(function ($nota) {
				return array(
					'nota' => $nota['Nota'],
					'data' => $nota['Data'],
					'descriere' => $nota['Descriere']
				);
			}, $note);

			return $this->view($model);
		}
	}
?>