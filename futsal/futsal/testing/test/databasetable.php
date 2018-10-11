<?php
	class DatabaseTable
	{
		public $pdo;
		public $table;
		function __construct($pdo,$table)
		{
			$this->pdo=$pdo;
			$this->table=$table;
		}

	function insert($array){
		$sql='insert into '.$this->table;
		$keys=array_keys($array);
		$values=implode(',', $keys);
		$values_with_colon=implode(', :', $keys);
		$sql.='('.$values.') values(:'.$values_with_colon.')';
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute($array);
	}

	function selectUnique($field, $value) {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $criteria = [
                'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt->fetch();
	}
	
	function selectAll(){
		$query = 'select * from '.$this->table;
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function update($criteria, $pk)
	{
	    $query = 'update '.$this->table.' set ';
	    $para = [];
	    foreach ($criteria as $field => $value) {
	        $para[] = $field.'= :'.$field;
	    }
	    $query.=implode(',', $para);
	    $query.=' where '.$pk.'=:id';
	    $stmt = $this->pdo->prepare($query);
	    $stmt->execute($criteria);
	    return true;
	}


	function save($record,$pk)
	{
		try
		{
			insert($record);
			$ret=true;
		}
		catch(Exception $e)
		{
			update($record,$pk);
			$ret=false;
		}
		return $ret;
	}

	}
?>