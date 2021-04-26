<?php

class Offices extends Database {
   public String $cacheFile = CACHE_PATH.'offices.json';
   
   public String $tableName = 'offices';
   
   public Array $tableFields = [
      'officeCode',
      'city',
      'phone',
      'addressLine1',
      'addressLine2',
      'state',
      'country',
      'postalCode',
      'territory'
   ];


}