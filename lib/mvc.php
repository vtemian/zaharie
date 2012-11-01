<?php
	/// Controller pipeline
	/// onInitiate -> onActionExecuting -> [Action] -> onActionExecuted
	abstract class Controller {
		public $appName;

		public $viewsPath;
		public $viewPath;

		/// {array}
		public $session;

		/// {array}
		public $data = array();

		public function __construct() {

		}

		protected function onInitiate() {
			// Session
			session_start();

			if ($this->appName) {
				if (!isset($_SESSION[$this->appName])) {
					$_SESSION[$this->appName] = array();
				}
				
				$this->session = &$_SESSION[$this->appName];
			}
			else {
				$this->session = &$_SESSION;
			}
		}

		protected function onActionExecuting() {
			$this->restoreFlash();
		}

		protected function onActionExecuted() {

		}

		protected function getControllerViewsDirectory() {
			return str_replace('Controller', '', lcfirst(get_class($this)));
		}

		public function dispatch($action, $params = array()) {
			$this->onInitiate();

			$this->viewPath = $this->viewsPath.$this->getControllerViewsDirectory().'/'.$action.'.php';

			$executingContext = array(
				'action' => $action,
				'params' => $params
			);

			$result = $this->onActionExecuting(&$executingContext);

			if (isset($executingContext['result'])) {
				return $this->executeResult($executingContext['result']);
			}

			$onExecutingMethod = $action.'_onExecuting';

			if (method_exists($this, $onExecutingMethod)) {
				$result = call_user_func_array(array($this, $onExecutingMethod), array(&$executingContext));

				if (isset($executingContext['result'])) {
					return $this->executeResult($executingContext['result']);
				}
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$actionMethod = $action.'_onPost';
				array_unshift($params, $_POST);
			}
			else {
				$actionMethod = $action;
			}

			$result = call_user_func_array(array($this, $actionMethod), $params);

			$this->onActionExecuted();

			return $this->executeResult($result);
		}

		private function executeResult($result) {
			if (is_string($result)) {
				$result = array('body' => $result);
			}

			if (isset($result['headers'])) {
				foreach ($result['headers'] as $name => $value) {
					if ($name == 'Location') {
						$this->saveFlash();
					}

					header($name.': '.$value);
				}
			}

			if (isset($result['body'])) {
				echo $result['body'];
			}
		}

		public function view($model = null) {
			if ($model) {
				$this->data['model'] = $model;
			}

			extract($this->data);

			ob_start();

			include $this->viewPath;

			$body = ob_get_contents();

			ob_end_clean();
			
			return array(
				'body' => $body
			);
		}

		public function redirect($url) {
			return array(
				'headers' => array(
					'Location' => $url
				)
			);
		}

		protected function flash($message, $error = false) {
			$this->data['flash'] = array(
				'message' => $message, 
				'error' => $error
			);
		}

		protected function saveFlash() {
			if (isset($this->data['flash'])) {
				$this->session['flash'] = $this->data['flash'];
			}
		}

		private function restoreFlash() {
			if (isset($this->session['flash'])) {
				$this->data['flash'] = $this->session['flash'];

				$this->session['flash'] = null;
			}
		}
	}
?>