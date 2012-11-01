<?php
	/// A MySql database connection driver.
	class MySqlConnection {
		/// {string} The mysql host;
		public $host;
		/// {string} The username;
		public $username;
		/// {string} The password;
		public $password;
		/// {string} The database;
		public $database;

		/// {Resource} The MySql connection resource.
		public $connection;
		
		/// {bool} Gets if the connection is open.
		public $isOpen = false;

		/// Creates a new MySqlDbConnection instance.
		/// @param {string} $host The mysql host.
		/// @param {string} $username The username.
		/// @param {string} $password The password.
		/// @param {string} $database The database.
		public function __construct($host, $username, $password, $database) {
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;
		}

		/// Opens the connection.
		public function open() {
			if ($this->isOpen) {
				$this->throwException('The connection is already open');
			}
			else {
				$this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
				
				$this->connection->query('SET NAMES utf8');
				
				if ($this->connection->connect_error) {
					$this->throwException($this->connection->connect_error);
				}
				
				$this->isOpen = true;
			}
		}
		
		/// Closes the connection.
		public function close() {
			if ($this->isOpen) {
				$this->connection->close();
				
				$this->connection = null;
				$this->isOpen = false;
			}
			else {
				$this->throwException('The connection is not open');
			}
		}
		
		/// @virtual Throws an exception specific to the database connection.
		/// @param {string} $message The exception message.
		protected function throwException($message) {
			throw new DbException($message);	
		}

		/// @override Formats the value of a string paramter.
		/// @param {string} $value The value of the parameter.
		/// @returns {string} The formatted value.
		protected function formatStringValue($value) {	
			if ($this->connection) {
				return '"'.$this->connection->real_escape_string($value).'"';
			}
			else {
				return '"'.mysql_escape_string($value).'"';
			}
		}

		/// @virtual Formats and returns the value of the given parameter.
		/// @param {string} $name The name of the parameter.
		/// @returns {string} The value of the parameter.
		protected function formatParameter($name, $params) {
			$value = $params[$name];
			$formatedValue = $value;
			
			if (is_null($value)) {
				$formatedValue = 'NULL';
			}
			else if (is_bool($value)) {
				$formatedValue = $value ? 'TRUE' : 'FALSE';
			}
			else if (is_int($value) || is_float($value)) {
				$formatedValue = (string)$value;
			}
			else if (is_string($value)) {
				$formatedValue = $this->formatStringValue($value);
			}
			
			return $formatedValue;
		}

		protected function buildCommand($command, $params) {
			$text = preg_replace('/(@?)(@([\w\.]+))/e', '\'\\1\' === \' \' ? \'\\2\' : $this->formatParameter(\'\\3\', $params)', $command);
			
			return $text;
		}

		/// @returns {array} The results of the query as an associative array.
		public function query($command, $params = array()) {
			if ($this->isOpen) {
				$sql = $this->buildCommand($command, $params);
				
				$query = $this->connection->query($sql);
				
				if ($query === false) {
					$this->throwException($this->connection->error.' in '.$sql);
				}
				else {
					$results = array();

					while ($current = $query->fetch_assoc()) {
						$results[] = $current;
					}

					$query->free();

					return $results;
				}
			}
			else {
				$this->throwException('The connection is not open');
			}
		}

		/// @returns {array} The result of the query as an associative array.
		public function one($command, $params = array()) {
			if ($this->isOpen) {
				$sql = $this->buildCommand($command, $params);
				
				$query = $this->connection->query($sql);
				
				if ($query === false) {
					$this->throwException($this->connection->error.' in '.$sql);
				}
				else {
					$result = $query->fetch_assoc();

					$query->free();

					return $result;
				}
			}
			else {
				$this->throwException('The connection is not open');
			}
		}

		/// @returns {int} The number of affected rows.
		public function execute($command, $params = array()) {
			if ($this->isOpen) {
				$sql = $this->buildCommand($command, $params);

				$query = $this->connection->query($sql);
				
				if ($query === false) {
					$this->throwException($this->connection->error.' in '.$sql);
				}
				else if ($query === true) {
					return $this->connection->affected_rows;
				}
				else {
					mysqli_free_result($query);
					
					return 0;
				}
			}
			else {
				$this->throwException('The connection is not open');
			}
		}
		
		/// Releases all resources used by the current instance of the MySqlConnection class.
		public function __destruct() {
			if ($this->isOpen) $this->close();	
		}
	}
?>