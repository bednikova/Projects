<?php
namespace Pragmatic\DBAL;

require_once __DIR__.'/Database.php';

class Paginator {
	
	private $itemsPerPage = 10;
	private $allItems = 0;
	
	public function __construct($itemsPerPage) {
		$this->itemsPerPage = $itemsPerPage;
	}
	
	public function setAllItems($allItems) {
		$this->allItems = $allItems;
	}
	
	public function createLimit($currentPage = null) {
		$limit = "LIMIT ".$this->calcOffset($currentPage).",{$this->itemsPerPage}";
		return $limit;
	}
	
	public function hasNext($currentPage = null) {
		$nextOffset = $this->calcOffset($currentPage) + $this->itemsPerPage;
		return $nextOffset < $this->allItems;
	}
	
	public function hasPrev($currentPage = null) {
		$page = $this->calculatePage($currentPage);
		return $page > 1;
	}
	
	public function previousPage($currentPage = null) {
		return max(0, ($this->calculatePage($currentPage) - 1) );
	}
	
	public function nextPage($currentPage = null) {
		$page = $this->calculatePage($currentPage);
		if ( $this->hasNext() ) {
			return $page+1;
		} else {
			return $page;
		}
	}
	
	protected function calculatePage($currentPage = null) {
		if ( $currentPage === null ) {
			$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
		} else {
			$page = $currentPage;
		}
		return $page;
	}
	
	protected function calcOffset($currentPage = null) {
		$page = $this->calculatePage($currentPage);
		$page = max(0, $page-1);
		$offset = $this->itemsPerPage * $page;
		return $offset;
	}
	
}
