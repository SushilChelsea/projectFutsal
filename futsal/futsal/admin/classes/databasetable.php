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
		$keys=array_keys($array);
		$values=implode(',', $keys);
		$values_with_colon=implode(', :', $keys);
		$query="INSERT INTO ".$this->table;
		$query.="(".$values.") values(:".$values_with_colon.')';
		$stmt=$this->pdo->prepare($query);
		if ($stmt->execute($array)) {
			return true;
		} else {
			return false;
		}
	}
//----------------------------------------------------------------------------
	function selectUnique($field, $value) 
	{
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $criteria = [
                'value' => $value
        ];
        $stmt->execute($criteria);
		$result = $stmt->fetch();
		// var_dump($result);
		return $result;

	}

	function selectColumn($selectField,$field, $value) 
	{
		$query='SELECT '.$selectField.' FROM '. $this->table . ' WHERE ' . $field . ' = :value';
	
        $stmt = $this->pdo->prepare($query);
        $criteria = [
                'value' => $value
        ];
        $stmt->execute($criteria);
        $data=$stmt->fetch();
        return $data;
	}

	//---------------------------------------------------------------------------------



	function selectAll()
	{
		$query = 'select * from '.$this->table;
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function update($array, $primarKeyField)
	{
		//id value is send from array and takes array value.
	    $query = 'UPDATE '.$this->table.' SET ';
	    $keys = [];
	    foreach ($array as $field => $value) {
	        $keys[] = $field.'= :'.$field;
	    }
	    $query.=implode(',', $keys);
	    $query.=' WHERE '.$primarKeyField.'=:'.$primarKeyField;
	    $stmt = $this->pdo->prepare($query);
	    $stmt->execute($array);
	    return true;
	}



	function delete($field,$value)
	{
		$query='DELETE FROM '.$this->table.' WHERE '. $field . ' = :value';
		$criteria=[
				'value'=>$value
		];
		$stmt=$this->pdo->prepare($query);
		$stmt->execute($criteria);
		return true;
	}

	// function save($record,$pk)
	// {
	// 	try
	// 	{
	// 		insert($record);
	// 		$ret=true;
	// 	}
	// 	catch(Exception $e)
	// 	{
	// 		update($record,$pk);
	// 		$ret=false;
	// 	}
	// 	return $ret;
	// }

}
?>