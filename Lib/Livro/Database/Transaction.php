<?php 
namespace Livro\Database;

use Livro\Log\Logger;

final class Transaction {

	private static $conn;
	private static $logger;
	private function __construct(){}
	
	public static function open($database){
		if(empty(self::$conn))
		{
			self::$conn = Connection::open($database);
			self::$conn->beginTransaction(); //inicia a transação
			self::$logger = NULL; //desliga o log sql
		}
	}
	public static function get() {
		return self::$conn; // retorna a conexão ativa
	}
	public static function rollback(){
		if(self::$conn) {
			self::$conn->rollback(); //desfaz as operaçoes não realizadas
			self::$conn = NULL;
		}
	}
	public static function close(){
		if (self::$conn) {
			self::$conn->commit(); //aplica as operações realizadas
			self::$conn = NULL;
		}
	}
	public static function setLogger(Logger $logger){
		self::$logger = $logger;
		}
	public static function log($message){
		if (self::$logger) {
			self::$logger->write($message);
		}
	}
	 
}
 ?>