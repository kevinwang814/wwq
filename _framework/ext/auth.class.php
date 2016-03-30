<?php
class Ext_Auth
{

   static function mustLogin()
   {
       if (!isset($_SESSION['user'])) {
	   R(U('account/login'));
           exit;
       }
   }
   
   static function isLogin() {
       if (!isset($_SESSION['user'])) {
           return false;
       }
       return true;
   }
   
   static function mustAdminLogin() {
       if (!sessionv('user.role')=='admin') {
           R(U('account/login'));
           exit;
       }
       return true;
   }
   
   static function filter_sign($test) {
       $text = preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1)+/",'',$text);
       return $text;
   }
   
   static function badWord($content) {
       $badExtend = importExtend('bad');
       $badWords = $badExtend->getAll(); 
       foreach($badWords as $word) {
           if(stristr($content,$word)) {
               //dump($word);
               return false;
           }
       }
       return true;
   }
}
