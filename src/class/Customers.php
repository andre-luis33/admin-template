<?php

class Customers extends Database {
   public String $cacheFile = CACHE_PATH.'customers.json';
   
   public String $tableName = 'customers';
   
   public Array $tableFields = [
      'customerNumber',
      'customerName',
      'contactLastName',
      'contactFirstName',
      'phone',
      'addressLine1',
      'addressLine2',
      'city',
      'state',
      'postalCode',
      'country',
      'salesRepEmployeeNumber',
      'creditLimit'
   ];

   function getView($offset) {
      $sql = "SELECT c.*,
               CASE
                  WHEN e.employeeNumber is null then '--'
                  WHEN e.employeeNumber is not null then concat(e.firstName, ' ', e.lastName)
               END as employeeName
               FROM customers c 
               LEFT JOIN employees e 
               ON e.employeeNumber = c.salesRepEmployeeNumber
               LIMIT 80 OFFSET {$offset}
      "; 

      $do = $this->doQuery($sql, $this->conn);
      return $do ? $do->fetchAll(PDO::FETCH_ASSOC) : false;
   }
}