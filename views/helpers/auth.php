<?php

App::import('Helper', 'Session');

class AuthHelper extends SessionHelper {
	function __construct($base = null) {
		parent::__construct($base);
	}

	function user($field = false) {
		$key = 'Auth.User';
		if ($field) {
			$key .= '.' . $field;
		}
		return $this->read($key);
	}
}
