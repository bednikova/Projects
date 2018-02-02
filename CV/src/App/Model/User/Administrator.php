<?php
namespace App\Model\User;

use App\Model\User as User;

class Administrator extends User {
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'guest';
	
}