<?php
namespace Pragmatic;

class FlashMessage {
	
	/**
	 *
	 * @var Session 
	 */
	protected static $session;
	
	public static function setSession(Session $session) {
		self::$session = $session;
	}
	
	public static function write($message) {
		self::$session->set('flashMessage', $message);
	}
	
	public static function read() {
		$message = self::$session->get('flashMessage', null);
		self::$session->set('flashMessage', null);
		return $message;
	}
	
}
