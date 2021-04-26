<?php

$conn = Database::getConnection();
$customer = new Customers();
$office = new Offices();

// if(!$countCustomers = Cache::countFromCache($customer->cacheFile)) {
//    $countCustomers = $customer->count($conn, $customer->tableName);
//    Cache::cacheCount($countCustomers, $customer->cacheFile);
// }

// if(!$countOffices = Cache::countFromCache($office->cacheFile)) {
//    $countOffices = $office->count($conn, $office->tableName);
//    Cache::cacheCount($countOffices, $office->cacheFile);
// }

$countCustomers = $customer->count($conn, $customer->tableName);
$countOffices = $office->count($conn, $office->tableName);

// ------------------ HTML ----------------------
title(
   'fas fa-home',
   'Home',
   'Seja bem-vindo(a) ao nosso sistema!'
);
?>

<div class="widgets-box">
   <?php
      widget(
         $countCustomers,
         'Clientes',
         'far fa-id-card',
         'green',
         'clientes'
      );
      
      widget(
         $countOffices,
         'Escritórios',
         'fas fa-building',
         'cyan',
         ''
      );
   ?>

</div>

<style>

   .widgets-box {
      display: flex;
      flex-wrap: wrap;
   }
   .widgets-box .widget {
      margin: 5px;
   }

</style>
<script src="<?= JS_PAGES_PATH ?>home.js"></script>