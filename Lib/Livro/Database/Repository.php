<?php 
namespace Livro\Database;	
final class Repository{
	private $activeRecord; //classe manipulada pelo repositorio

	function __construct($class) {
		$this->activeRecord = $class;
	}

	function load(Criteria $criteria){
		//instancia a instrução SELECT
		$sql = "SELECT * FROM " . constant($this->activeRecord.'::TABLENAME');
		//obtem a clausula where do objeto criteria
		if ($criteria) {
			$expression = $criteria->dump();
			if ($expression) {
				$sql .= ' WHERE ' . $expression;
			}
			//obtem as propriedades do criterio
			$order = $criteria->getProperty('order');
			$limit = $criteria->getProperty('limit');
			$offset= $criteria->getProperty('offset');

			//obtem a ordenação do SELECT
			if ($order) {
				$sql .= ' ORDER BY ' . $order;
			}
			if ($limit) {
				$sql .= ' LIMIT ' . $limit;
			}
			if ($offset) {
				$sql .= ' OFFSET ' . $offset;
			}
		}
		//obtem a transação ativa
		if ($conn = transaction::get()) {
			Transaction::log($sql); //registra a mensagem de log
			//executa a consulta no banco de dados
			$result= $conn->query($sql);
			$results = array();

			if ($result) {
				//percorre os resultados da consulta, retornando um objeto
				while ($row = $result->fetchObject($this->activeRecord)) {
					//armazena no array $results
					$results[] = $row;
				}
			}
			return $results;
		}
		else {
			throw new Exception('Não há transação ativa!!');
			
		}
	}
	function delete(Criteria $criteria){
		$expression = $criteria->dump();
		$sql = "DELETE FROM " . constant($this->activeRecord.'::TABLENAME');
		if ($expression) {
			$sql .= ' WHERE ' . $expression;
		}
		//obtém a transação ativa
		if ($conn = Transaction::get()) {
		 	Transaction::log($sql); //registra a mensagem de log
		 	$result = $conn->exec($sql); //executa a instrução de delete
		 }
		 else {

		 	throw new Exception('Não há transação ativa!!');
		 	
		 } 

	}
	function count(Criteria $criteria) {
		$expression = $criteria->dump();
		$sql = "SELECT COUNT(*) FROM " .constant($this->activeRecord.'::TABLENAME');
		if ($expression) {
			$sql .= ' WHERE ' . $expression;
		}
		//obtem a transação ativa
		if ($conn = Transaction::get()) {
			Transaction::log($sql); //registra a mensagem de log
			$result = $conn->query($sql); //executa a instrução de select
			if ($result) {
				$row = $result->fetch();
			}
			return $row[0]; //retorna o resultado 
		}
		else{
			throw new Exception('Não há transação ativa!!');
			
		}
	}
}


 ?>