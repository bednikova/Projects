<?php

namespace App\Model;
use Pragmatic\Model as Model;


class Home extends Model {
    
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'home';

	
	
	protected $firstName;
        protected $lastName;
        protected $dateOfBirth;
        protected $address;
        protected $phone;
        protected $email;



        public function getFirstName() {
            return $this->firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function getDateOfBirth() {
            return $this->dateOfBirth;
        }

        public function getAddress() {
            return $this->address;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
            return $this;
        }

        public function setDateOfBirth($dateOfBirth) {
            $this->dateOfBirth = $dateOfBirth;
            return $this;
        }

        public function setAddress($address) {
            $this->address = $address;
            return $this;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
            return $this;
        }

        public function setEmail($email) {
            $this->email = $email;
            return $this;
        }


   
    
}
