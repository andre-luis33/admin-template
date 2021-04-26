<?php

class Cache {

   public static function cacheCount(Int $count, $filePath): void {
      $file = json_decode( file_get_contents($filePath), true );
      
      if($file['expires_on'] < time()) {
         $file = [
            'expires_on' => strtotime('+1 day'),
            'count' => $count
         ];
      }

      $new = fopen($filePath, 'w');
      fwrite($new, json_encode($file));
      fclose($new);
   }

   public static function countFromCache($filePath) {
      $file = json_decode( file_get_contents($filePath), true );
      return $file['expires_on'] > time() ? $file['count'] : false;
   }
}

?>