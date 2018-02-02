<?php
namespace App\Model;

use \Pragmatic\Model as Model;

class User extends Model {
	
	/**
	 * Regex for matching username. It allows only alphanumneric strings
	 */
	const VALID_USERNAME_REGEX = '^[A-Za-z0-9]*$';
	
	/**
	 * Regex for password. Password should contain at least 8 characters
	 */
	const VALID_PASSWORD_REGEX = '^.{8,}$';
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'guest';
	
	/**
	 * An array of all properties, which need to be unique
	 * @var Array
	 */
	protected static $uniqueProperties = array(
		'username',
		'password'
  
	);
	
	/**
	 * The username of the user
	 * @var string
	 */
	protected $username;
	
	/**
	 * The password of the user
	 * @var string
	 */
	protected $password;
	
	
	/**
	 * Returns the username
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Returns the password
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Sets and validates the username
	 * @param type $username
	 * @return \User
	 */
	public function setUsername($username) {
		if ( !$this->validate('username', $username) ) {
			return false;
		}
		
		$this->username = $username;
		return true;
	}

	/**
	 * Sets and validates the password
	 * @param type $password
	 * @return \User
	 */
	public function setPassword($password) {
		if ( !$this->validate('password', $password) ) {
			return false;
		}
		$this->password = $password;
		return true;
	}
	
	/**
	 * Chanegs the user password only if 
	 * @param type $oldPassword
	 * @param type $newPassword
	 * @return boolean
	 */
	public function changePassword($oldPassword, $newPassword) {
		
		if ( $oldPassword != $this->password ) {
			return false;
		}
		if (!$this->validate('password', $newPassword)) {
			return false;
		}
		
		$this->password = $newPassword;
		
	}
	
	/**
	 * 
	 * Checks if the provided credentials are ok
	 * 
	 * @param type $usename
	 * @param type $password
	 * @return boolean
	 */
	public static function checkCredentials( $usename, $password ) {
		
		$where = sprintf("`username` = %s AND `password` = %s", self::$dataBase->escape($usename), self::$dataBase->escape($password)); 
		
		$results = static::$dataBase->select(static::$tableName, $where);
		
		if ( count($results) != 1 ) {
			return null;
		} else {
			$dbData = array_pop($results);
		}
		
		return static::hydrateDBData($dbData);
		
	}
	
	
}