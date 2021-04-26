<?php

$customer = new Customers();
$customer->setConnection();


if($_GET['type'] == 'get-data') {
   $offset = $_GET['offset'];
   
   if(!is_numeric($offset)) {
      returnRequest(400);
   }
   
   error_reporting(E_ALL);
   $data = $customer->getView($offset);

   if(!$data) 
      returnRequest(500);
   else
      returnRequest(200, 'Success', $data);
}



?>