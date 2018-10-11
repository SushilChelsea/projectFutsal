<?php
	class DatabaseTable
	{
		public $pdo;
		public $table;
		function __construct($pdo,$table) {
			$this->pdo=$pdo;
			$this->table=$table;
		}

		//@this are the general functions required
		function insert($array) {
			$query='insert into '.$this->table;
			$keys=array_keys($array);
			$values=implode(',', $keys);
			$values_with_colon=implode(', :', $keys);
			$query.='('.$values.') values(:'.$values_with_colon.')';
			$statement=$this->pdo->prepare($query);
			// $statement->execute($array);
			if ($statement->execute($array)) {
				return true;
			} else {
				return false;
			}
		}

		function selectUnique($field, $value) {
			$query='SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value';
			$statement = $this->pdo->prepare($query);
			$requirements = [
					'value' => $value
			];
			$statement->execute($requirements);
			return $statement->fetch();
		}
		
		function selectAll() {
			$query = 'select * from '.$this->table;
			$statement = $this->pdo->prepare($query);
			$statement->execute();
			return $statement->fetchAll();
		}

		function update($array, $pk) {
			$query = 'update '.$this->table.' set ';
			$para = [];
			foreach ($array as $field => $value) {
				$para[] = $field.'= :'.$field;
			}
			$query.=implode(',', $para);
			$query.=' where '.$pk.'=:id';
			$statement = $this->pdo->prepare($query);
			$statement->execute($array);
			return true;
		}

		/* if coloumn name matched more than once */
		function selectMatchedColumnName($field, $value) {
			$query='SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value';
			$statement = $this->pdo->prepare($query);
			$requirements = [
					'value' => $value
			];
			$statement->execute($requirements);
			return $statement->fetchAll();
		}

		/* if selecting from 2 colomn field */
		function selectMultipleColumnName($field1, $value1, $field2, $value2) {
			$query='SELECT * FROM ' . $this->table . ' WHERE ' . $field1 . ' = :value1'.' AND '.$field2.' = :value2';
			$statement = $this->pdo->prepare($query);
			$requirements = [
					'value1' => $value1,
					'value2' => $value2
			];
			$statement->execute($requirements);
			return $statement->fetchAll();
		}

		/* if selecting from 3 colomn field */
		function selectFromThreeColumnName($field1, $value1, $field2, $value2, $field3, $value3) {
			$query='SELECT * FROM ' . $this->table . ' WHERE ' . $field1 . ' = :value1'.' AND '.$field2.' = :value2' . ' AND ' . $field3 . ' = :value3';
			$statement = $this->pdo->prepare($query);
			$requirements = [
					'value1' => $value1,
					'value2' => $value2,
					'value3' => $value3
			];
			$statement->execute($requirements);
			return $statement->fetchAll();
		}
	}
?>