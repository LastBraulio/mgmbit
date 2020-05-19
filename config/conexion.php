<?php



class Conexiones
{
		public $pdo;
		public function __construct() 
		{
			try 
			{
				$this->pdo = new PDO ("mysql:host=localhost;dbname=academico","root","");
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				

			} 
			catch (PDOException $e)
			{
				echo 'connection failed: '.$e->getMessage();
			}
		}
}   

?>
