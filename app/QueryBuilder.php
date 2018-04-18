<?php

namespace App;

class QueryBuilder {
	
	protected $table;
	protected $db;
	
	public function __construct( Database $db )
	{
		$this->db = $db;
	}
	
	public function table($table)
	{
		$this->table = $table;
		
		return $this;
	}
	
	public function get_where($what, $condition, $thing)
	{
		$stmt = "SELECT * FROM $this->table WHERE $what $condition $thing";
		
		$stmt = $this->db->pdo()->prepare($stmt);
		
		$stmt->execute();
		
		return $result = $stmt->fetchAll();
	}
}