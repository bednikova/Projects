<?php
namespace App\Model\User;

use App\Model\User as User;

class Customer extends User {
	
	
	
	/**
	 * Regex for validating names. It allows only alpha characters, white spaces and single quotes
	 */
	const VALID_NAME_REGEX = '^[A-Za-z\'\s]*$';
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'information';
	
	/**
	 * The email of the user
	 * @var string
	 */
	protected $first;
	
	/**
	 * The first name of the user
	 * @var string
	 */
	protected $last;
	
	/**
	 * The last name of the user
	 * @var type 
	 */
	protected $phone;
        
        protected $username;
        
        protected $password;
        
        protected $dateOfBirth;
        
        protected $email;
        
        protected $address;


        public function getDateOfBirth() {
		return $this->dateOfBirth;
	}

        public function getEmail() {
		return $this->email;
	}

        public function getAddress() {
		return $this->address;
	}


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
	 * Returns the email
	 * @return string
	 */
	public function getFirst() {
		return $this->first;
	}

	/**
	 * Returns the first name of the user
	 * @return string
	 */
	public function getLast() {
		return $this->last;
	}

	/**
	 * Returns the last name of the user
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	

	/**
	 * Sets and validates the email
	 * @param type $first
	 * @return \User
	 */
	public function setFirst($first) {
		if ( !$this->validate('name', $first) ) {
			return false;
		}
		
		$this->first = $first;
		return true;
	}

	/**
	 * Sets and validates the first name
	 * @param type $last
	 * @return \User
	 */
	public function setLast($last) {
		if ( !$this->validate('name', $last )) {
			return false;
		}
		$this->last = $last;
		return true;
	}

	/**
	 * Sets and validates the last name
	 * @param type $phone
	 * @return \User
	 */
	public function setPhone($phone) {
		
		$this->phone = $phone;
		return true;
	}
        
        public function setAddress($add) {
		
		$this->address = $add;
		return true;
	}

        public function setEmail($email) {
		
		$this->email = $email;
		return true;
	}
        public function setDateOfBirth($date) {
		
		$this->dateOfBirth = $date;
		return true;
	}

	
}