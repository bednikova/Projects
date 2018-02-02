<?php
namespace Pragmatic;

class Session {
	
	public function __construct() {
		session_start();
	}
	
	public function get($name, $default = null) {
		if ( !array_key_exists($name, $_SESSION) ) {
			return $default;
		}
		
		return $_SESSION[$name];
	}
	
	public function set($name, $value) {
		
		$_SESSION[$name] = $value;
		
	}
	
}

