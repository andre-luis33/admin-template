<?php

class Database {
   public PDO $conn;
   public static string $logFile = '../src/log/database.txt';
      
   static function getConnection(){ 

      try{
         $conn = new PDO('mysql:host='.dbHOST.';dbname='.dbNAME, dbUSER, dbPASSWORD);
         // $conn = new PDO('mysql:host='.dbHOST.';dbname={$env['dbname']}", $env['user'], $env['password']);

         return $conn;

      } catch(PDOException $e){

         $erro = $e->getMessage();
         
         $id_erro = rand(1, 999);
         $date = date('d-m-Y H:i:s');
         $log = "\n\nCódigo do erro: $id_erro às $date\n";
         $log .= "{\nErro na conexao com o servidor\nErro: $erro\n}";
         $file_log = fopen(Database::$logFile, 'a');
         fwrite($file_log, $log);
         fclose($file_log);

         return false;
         
      }
   }

   public function setConnection($conn = false) {
      $this->conn = !$conn ? $this->getConnection() : $conn; 
   }

   static function logError($query, $msg, $str_query){
      $code = rand(1, 500);
      $error_msg = $msg . $code;
      $date = date('d-m-Y H:i:s');
      
      $log = "\n{\nCódigo: $code às $date\n Query -> $str_query";
      foreach($query->errorInfo() as $value){
            $log .= "\n$value";
      }
      $log .= "\n}";

      $file_log = fopen(Database::$logFile, 'a');
      fwrite($file_log, $log);
      fclose($file_log);
      return $error_msg;
   }

   /**
    * Executa qualquer query de forma fácil e menos verbosa
    * @param String $sql SQL Statement
    * @param PDO $conn Uma conexão válida com o banco de dados
    * @return PDO Objeto para ser manipulado, com fetch e tals
    */
   static function doQuery($sql, PDO $conn){
      $query = $conn->prepare($sql);
      $result = $query->execute();
      if($result){
         return $query;
      } else {
         $msg = "Erro na função Database::doQuery\n Código de erro:";
         Database::logError($query, $msg, $sql);
         return false;
      }
   }

   ########### bind de único valor ##########
   static function doQuery_bind($sql, $conn, $value){
      if(is_int($value)){
         $bind = PDO::PARAM_INT;
      } else {
         $bind = PDO::PARAM_STR;
      }
      $value = strip_tags($value);
      $query = $conn->prepare($sql);
      $query->bindParam(1, $value, $bind);
      if($query->execute()){
         return $query;
      } else {
         echo "Erro na query: $sql <br>";
         print_r($query->errorInfo());
      }
   }

   ######### bind de múltiplos valores #############
   static function doQuery_bindArray($sql, $conn, $value){
      $count = 0;
      $query = $conn->prepare($sql);

      foreach($value as $key){
         $count++;
         if(is_int($key)){
               $bind = PDO:: PARAM_INT;
         } else {
               $bind = PDO:: PARAM_STR;
         }
         $bind = strip_tags($bind);
         
         $query->bindValue($count, $key, $bind);
      }

      if($query->execute()){
         // $_SESSION['query_success'] = 'true';
         return $query;
      } else {
         echo "Erro na query: $sql <br>";
         print_r($query->errorInfo());
      }
   }

   ######### bind de varias vezes para um unico valor ###########
   static function doQuery_bindSameValue($sql, $conn, $value, $count){

      $query = $conn->prepare($sql);
      for($i = 1; $i <= $count; $i++){
         $query->bindValue($i, $value);
      }
      if($query->execute()){
         return $query;
      } else {
         echo "Erro na query: $sql <br>";
         print_r($query->errorInfo());
      }
   }


   static function count($conn = false, $tableName, $alias = 'total', $rawWhere = '1=1') {
      $conn = $conn ? $conn : Database::getConnection();
      $sql = "SELECT count(*) as {$alias} FROM {$tableName} WHERE {$rawWhere}";
      $do = Database::doQuery($sql, $conn);
      return $do->fetchColumn();
   }
   
   static function getAll($conn = false, $fields = '*', $tableName, $rawWhere = '1=1') {
      $conn = $conn ? $conn : Database::getConnection();
      $sql = "SELECT {$fields} FROM {$tableName} WHERE {$rawWhere}";
      $do = Database::doQuery($sql, $conn);
      return $do->fetchAll(PDO::FETCH_ASSOC);
   }

}