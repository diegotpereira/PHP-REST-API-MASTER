<?php
   class Database{
       private $host = "localhost";
       private $database_name = "php_rest_api_master";
       private $usuario = "root";
       private $senha = "root";

       public $conexao;

       public function getConnetion(){
           $this->conexao = null;

           try {
               //code...
               $this->conexao = new PDO("mysql:host=" .$this->host . ";dbname=" .$this->database_name, $this->usuario, $this->senha);
               $this->conexao->exec("set names utf8");
               echo "Sucesso ao conectar no banco de dados!";
           } catch (PDOException $exception) {
               //throw $th;
               echo "Não foi possível conectar ao banco de dados: " . $exception->getMessage();
           }
           return $this->conexao;
       }
   }
?>