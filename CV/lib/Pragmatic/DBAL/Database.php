<?php
namespace Pragmatic\DBAL;

require_once __DIR__.'/TableJoin.php';
class Database {
	
	/**
	 *
	 * @var String
	 */
	private $user;
	
	/**
	 *
	 * @var String
	 */
	private $pass;
	
	/**
	 *
	 * @var String
	 */
	private $host;
	
	/**
	 *
	 * @var String
	 */
	private $db;
	
	/**
	 *
	 * @var String
	 */
	private $charset;


	/**
	 *
	 * @var resource
	 */
	private $link = null;

	/**
	 * 
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $db
	 * @param string $charset
	 */
	public function __construct($host,$user, $pass, $db, $charset = 'utf8') {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
		$this->charset = $charset;
	}

	/**
	 * Connects to the database if nessecery and return the link
	 * 
	 * @return link Databaselink
	 */
	public function getLink() {
		
		if ( $this->link === null ) {
			$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
			
			if ( !$this->link ) {
				trigger_error("Error connecting to database {$this->user}@{$this->host}. MySQL said: ".  mysqli_error(), E_USER_ERROR);
			}
			
			mysqli_set_charset($this->link, $this->charset);
		}
		
		return $this->link;
		
	}
	
	/**
	 * 
	 * Executes a mysql query and returns the raw result
	 * 
	 * @param string $query
	 * @return mysqli_result
	 */
	public function query($query) {
		
		$result = mysqli_query($this->getLink(), $query)
			or trigger_error("Error executing query $query. MySQL said: ". mysqli_error($this->getLink()));
			
		return $result;
		
	}
	
	/**
	 * 
	 * Retrieves the count of rows matching the where clause
	 * 
	 * @param type $table
	 * @param type $where
	 * @param type $joins
	 * @return int
	 */
	public function getCount($table, $where='', $joins = array()) {
		$joins = $this->buildJoins($joins);
		$where = empty($where) ? '' : "WHERE $where";
		$query = "SELECT COUNT(*) FROM `$table` $joins $where";
		$result = $this->query($query); 
		return mysqli_fetch_array($result)[0];
	}
	
	/**
	 * 
	 * Selects rows
	 * 
	 * @param string $table the name of the table
	 * @param string $where the where clause
	 * @param string $limit the limit clause
	 * @param string $columns the columns clause
	 * @param bool $calulateRows will calculate the found rows, which can then be fetched with numFoundRows()
	 * @param TableJoin[] $joins an array of join definitions
	 * @return array an array of associative arrays, containing the rows
	 */
	public function select( $table, $where='', $limit='', $columns = '*', $calulateRows = false, $joins = array(), $groupBy = '' ) {
		
		$joins = $this->buildJoins($joins);
		
		$foundRows = $calulateRows ? 'SQL_CALC_FOUND_ROWS' : '';
		$where = empty($where) ? '' : "WHERE $where";
		$groupBy = empty($groupBy) ? '' : "GROUP BY $groupBy";
		$query = "SELECT $foundRows $columns FROM `$table` $joins $where $groupBy $limit";
		$result = $this->query($query); 
				
		
		$results = array();
		
		while ( ($row = mysqli_fetch_assoc($result)) != false ) {
			
			if ( array_key_exists('id', $row) ) {
				$results[$row['id']] = $row;
			} else {
				$results[] = $row;
			}
			
		}
		
		return $results;
		
	}
	
	/**
	 * Returns the number of found rows in the last successful SELECT statement
	 * @return type
	 */
	public function numFoundRows() {
		$res = $this->query("SELECT FOUND_ROWS();");
		return mysqli_fetch_array($res)[0];
	}
	
	/**
	 * 
	 * Selectes a single row by id
	 * 
	 * @param type $table
	 * @param type $id
	 * @param type $columns
	 * @param type $joins
	 * @return array an associative array, containing the row
	 */
	public function selectById( $table, $id, $columns = '*', $joins = array(), $groupBy = '' ) {
		
		$row = $this->select($table, "`$table`.id = ".$this->escape($id), 'LIMIT 1', $columns, false, $joins, $groupBy);
		if ( !empty($row) ) {
			return array_pop($row);
		}
		
		return false;
		
	}
	
	/**
	 * Inserts data into the table
	 * @param type $table
	 * @param type $data
	 * @return int The id of the inserted record
	 */
	public function insert( $table, $data ) {
		
		$columns = $this->escapeArray(array_keys($data), '`');
		$values = $this->escapeArray($data);
		
		$query = "INSERT INTO `$table` (".  implode(',', $columns).") "
				. "VALUES (".implode(',',$values).")";
		
		$this->query($query);
		
		return mysqli_insert_id($this->getLink());
	}
	
	/**
	 * Updates record/s in the table with the provided data
	 * @param type $table
	 * @param type $dataToUpdate
	 * @param type $where
	 * @return int the number of changed rows in the table
	 */
	public function update($table, $dataToUpdate, $where) {
		
		$setStrings = '';
		
		foreach ( $dataToUpdate as $column=>$value ) {
			$setStrings[] = $this->escape($column,'`')." = ".$this->escape($value);
		} 
		
		$query = "UPDATE `$table` SET ". implode(',', $setStrings)." WHERE $where";
		
		$this->query($query);
		
		return mysqli_affected_rows($this->getLink());
	}
	
	/**
	 * Updates a single record in the table. Uses Database::update internally
	 * 
	 * @see Database::update
	 * 
	 * @param type $table
	 * @param type $dataToUpdate
	 * @param type $id
	 * @return int the number of changed rows in the table
	 */
	public function updateById($table, $dataToUpdate, $id) {
		
		$whereString = "id = ".$this->escape($id)." LIMIT 1";
		
		$this->update($table, $dataToUpdate, $whereString);
		
		return true; 
		
	}
	
	/**
	 * Deletes a record by id
	 * @param type $table
	 * @param type $id
	 * @return int the number of deleted rows in the table
	 */
	public function deleteById( $table, $id ) {
		$query = "DELETE FROM `$table` WHERE id = ".$this->escape($id);
		$this->query($query);
		return mysqli_affected_rows($this->getLink());
	}
	
	/**
	 * 
	 * Deletes records
	 * 
	 * @param type $table
	 * @param type $where
	 * @return int the number of deleted rows in the table
	 */
	public function delete ($table, $where) {
		$query = "DELETE FROM `$table` WHERE $where ";
		$this->query($query);
		return mysqli_affected_rows($this->getLink());
	}
	
	/**
	 * 
	 * Internal method to build the joins string
	 * 
	 * @param type $joins
	 * @return string
	 */
	private function buildJoins( $joins ) {
		
		if ( empty($joins) ) {
			return '';
		}
		
		$joinsString = '';
		
		foreach ( $joins as $join ) {
			/* @var $join TableJoin */
			$joinsString .= $join->getJoinType()." `".$join->getRightTable()."` ON `".$join->getLeftTable()."`.".$join->getLeftColumns()." = `".$join->getRightTable()."`.".$join->getRightColumns()." ";
		}
		
		return $joinsString;
		
	}
	
	/**
	 * Internal method to escape an array
	 * @param type $arrayToEscape
	 * @param type $quote the quote to use as a string
	 */
	public function escapeArray( $arrayToEscape, $quote = "'" ) {
		array_walk($arrayToEscape, function(&$value) use ($quote) {
			$value = $this->escape($value, $quote);
		});
		
		return $arrayToEscape;
	}
	
	/**
	 * Internal method to escale a single value
	 * @param type $value
	 * @param type $quote
	 * @return type
	 */
	public function escape($value, $quote = "'") {
		return $quote.mysqli_real_escape_string($this->getLink(), $value).$quote;
	}
	
}