<?php
namespace Pragmatic;

use Pragmatic\DBAL\Database as Database;
use Pragmatic\DBAL\Paginator as Paginator;
use Pragmatic\DBAL\TableJoin as TableJoin;

abstract class Model {
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'xxx';
	
	/**
	 * An array of all properties, which need to be unique
	 * @var Array
	 */
	protected static $uniqueProperties = array();
	
	/**
	 *
	 * @var Database
	 */
	protected static $dataBase;
	
	/**
	 * The id of the user
	 * @var int
	 */
	protected $id;
	
	/**
	 * Returns the user id
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	
	/**
	 * Validates a value, if there is a regex defined for its property name
	 * @param type $property
	 * @param type $value
	 * @return boolean
	 */
	public function validate($property, $value) {
		
		$regexConstantName = "static::VALID_".strtoupper($property)."_REGEX";
		
		if ( !defined( $regexConstantName ) ) {
			return $this->validateUnique($property, $value);
		}
		
		if (preg_match('/'.constant($regexConstantName).'/', $value)) {
			return $this->validateUnique($property, $value);
		} else {
			throw new \Exception("The value $value does not match regex ".constant($regexConstantName));
		}		
	}
	
	/**
	 * 
	 * If the given property name is in the array of unique properties,
	 * this method will check the uniqueness of the new value
	 * 
	 * @param type $propertyName
	 * @param type $newValue
	 * @return boolean
	 */
	protected function validateUnique($propertyName, $newValue) {
		
		if ( !in_array($propertyName, static::$uniqueProperties) ) {
			return true;
		}
		
		$where = sprintf("%s = %s", self::$dataBase->escape($propertyName,'`'), self::$dataBase->escape($newValue));
		
		if ( $this->id !== null ) {
			$where.=" AND `id` <> {$this->id}";
		}
		
		$count = self::$dataBase->getCount(static::$tableName, $where);
		
		if ( $count > 0 ) {
			throw new \Exception("The value for $propertyName - $newValue is not unique");
		} else {
			return true;
		}
		
	}
		
	
	
	/**
	 * BEGIN OF DATABASE METHODS
	 */
	
	/**
	 * Sets the database instance
	 * @param Database $db
	 */
	public static function setDB(Database $db) {
		self::$dataBase = $db;
	}
	
	/**
	 * Fetches all Items
	 * 
	 * @param string $where where clause for the models
	 * @param Paginator $paginator an instance of the paginator class
	 * @return Model[]
	 */
	public static function listItems($where = '', Paginator $paginator = null) {
		
		$joins = static::getJoins();
		$columnsToSelect = static::getColumns();
		$group = static::getGroupBy();
		
		if ( $paginator === null ) {
			$dbData = self::$dataBase->select(static::$tableName, $where, null, $columnsToSelect, false, $joins, $group);
		} else {
			$dbData = self::$dataBase->select(static::$tableName, $where, $paginator->createLimit(), $columnsToSelect, true, $joins, $group);
			$paginator->setAllItems(self::$dataBase->numFoundRows());
		}
		
		$items = array();
		
		foreach ($dbData as $id => $itemRow) {
			$items[$id] = static::hydrateDBData($itemRow);
		}
		
		return $items;
	}
	
	/**
	 * Fetches an order by id
	 * 
	 * @param type $id
	 * @return Model
	 */
	public static function loadById($id) {
		
		$joins = static::getJoins();
		$columnsToSelect = static::getColumns();
		$group = static::getGroupBy();
		
		$dbData = self::$dataBase->selectById(static::$tableName, $id, $columnsToSelect, $joins, $group);
		if (!$dbData) {
			return null;
		}
		return static::hydrateDBData($dbData);
	}
	
	/**
	 * 
	 * Internal method to fetch all joins
	 * 
	 * @return type
	 */
	protected static function getJoins() {
		return array();
	}
	
	/**
	 * 
	 * Internal method for fetching all columns definition
	 * 
	 * @return string
	 */
	protected static function getColumns() {
		return '*';
	}
	
	/**
	 * 
	 * Internal method for fetching the group by condition
	 * 
	 * @return string
	 */
	protected static function getGroupBy() {
		return '';
	}

	/**
	 * Internal method to create and populate a Model object with data from the database
	 * @param type $dbData
	 * @return Model
	 */
	protected static function hydrateDBData($dbData) {
		$className = get_called_class();
		$item = new $className();
		$itemData = ModelHelper::convertToModelData($dbData, $item);
		foreach ($itemData as $property => $value) {
			$item->$property = $value;
		}
		return $item;
	}
	
	/**
	 * 
	 * Public method to hydrate an existing model with post data
	 * 
	 * @param type $postData
	 * @return Model|boolean
	 */
	public static function createFromPOSTData($postData) {
		$className = get_called_class();
		$item = new $className();
		if ( key_exists('id', $postData) ) {
			unset($postData['id']);
		}
		foreach ($postData as $key => $value) {
			
			try {
				$item->{'set'.ucfirst($key)}($value);
			} catch (\Exception $ex) {
				$errors[] = $ex->getMessage();
			}
			
		}
		
		if ( !empty($errors) ) {
			throw new \Exception(implode("\n",$errors));
		}
		
		return $item;
	}
	
	/**
	 * 
	 * @param type $postData
	 * @return boolean
	 */
	public function hydrateFromPOSTData($postData) {
		
		if (array_key_exists('id', $postData)) {
			unset($postData['id']);
		}
		
		$errors = array();
		
		foreach ($postData as $key => $value) {
			
			try {
				$this->{'set'.ucfirst($key)}($value);
			} catch (\Exception $ex) {
				$errors[] = $ex->getMessage();
			}
			
		}
		
		if ( !empty($errors) ) {
			throw new \Exception(implode("\n",$errors));
		}
		
		return true;
		
	}

	/**
	 * 
	 * Updates the database with the current data in the model object
	 * 
	 * @return boolean
	 */
	public function update() {
		if ( $this->id === null ) {
			throw new \Exception("This model instance does not have an id, it is probably not in the database");
		}
		
		$arrayData = $this->toArray();
		unset($arrayData['id']);
		
		return self::$dataBase->updateById(static::$tableName, $arrayData, $this->id);
	}
	
	/**
	 * 
	 * Internal method to convert the model to an array
	 * 
	 * @return array
	 */
	protected function toArray() {
		return ModelHelper::modelToArray($this);
	}
	
	/**
	 * Deletes the current user object from the database
	 * @return boolean
	 */
	public function delete() {
		
		if ( $this->id === null ) {
			throw new \Exception("This model instance does not have an id, it is probably not in the database");
		}
		
		return self::$dataBase->deleteById(static::$tableName, $this->id);
		
	}
	
	/**
	 * Inserts the current user object into the database
	 * @return boolean
	 */
	public function insert() {
		
		if ( $this->id !== null ) {
			throw new \Exception("This already has an id, probably it is already in the database");
		}
		
		$arrayData = $this->toArray();
		unset($arrayData['id']);
		
		$id = self::$dataBase->insert(static::$tableName, $arrayData);
		
		if ( $id ) {
			$this->id = $id;
			return true;
		} else {
			return false;
		}
		
	}
	
}

