<?php
namespace Pragmatic\DBAL;

class TableJoin {
	
	const JOIN_LEFT = 'LEFT JOIN';
	const JOIN_RIGHT = 'RIGHT JOIN';
	const JOIN_INNER = 'INNER JOIN';
	
	/**
	 *
	 * @var string
	 */
	private $leftTable;
	
	/**
	 *
	 * @var string
	 */
	private $rightTable;
	
	/**
	 *
	 * @var string
	 */
	private $leftColumns;
	
	/**
	 *
	 * @var string
	 */
	private $rightColumns;
	
	/**
	 *
	 * @var string
	 */
	private $joinType;
	
	/**
	 * Returns the left table as a string
	 * @return string
	 */
	public function getLeftTable() {
		return $this->leftTable;
	}

	/**
	 * Returns the right table as a string
	 * @return type
	 */
	public function getRightTable() {
		return $this->rightTable;
	}

	/**
	 * Returns the left columns as a string
	 * @return type
	 */
	public function getLeftColumns() {
		return $this->leftColumns;
	}

	/**
	 * Returns the right columns as a string
	 * @return type
	 */
	public function getRightColumns() {
		return $this->rightColumns;
	}
	
	/**
	 * Returns the join type as a string.
	 * @see Database::JOIN_LEFT, 
	 * @see Database::JOIN_RIGHT, 
	 * @see Database::JOIN_INNER
	 * @return string
	 */
	public function getJoinType() {
		return $this->joinType;
	}

	/**
	 * Sets the name of the left table
	 * @param type $leftTable
	 * @return \TableJoin
	 */
	public function setLeftTable($leftTable) {
		$this->leftTable = $leftTable;
		return $this;
	}

	/**
	 * Sets the name of the right table
	 * @param type $rightTable
	 * @return \TableJoin
	 */
	public function setRightTable($rightTable) {
		$this->rightTable = $rightTable;
		return $this;
	}

	/**
	 * Sets the left column
	 * @param type $leftColumns
	 * @return \TableJoin
	 */
	public function setLeftColumns($leftColumns) {
		$this->leftColumns = $leftColumns;
		return $this;
	}

	/**
	 * Sets the right column
	 * @param type $rightColumns
	 * @return \TableJoin
	 */
	public function setRightColumns($rightColumns) {
		$this->rightColumns = $rightColumns;
		return $this;
	}

	/**
	 * Sets the join type
	 * @param type $joinType
	 * @return \TableJoin
	 */
	public function setJoinType($joinType) {
		$this->joinType = $joinType;
		return $this;
	}
	
}

