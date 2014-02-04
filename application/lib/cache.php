<?php

final class cache {
    
   public function write($filename , $string){
       $fn = fopen($filename, 'a+');
       fwrite($fn, $string);
       fclose($fn);
   }
   public function read($filename){
       $fn = fopen($filename , 'r');
       $read = fread($fn, filesize($filename));
       fclose($fn);
       return $read;
   }
}

?>
