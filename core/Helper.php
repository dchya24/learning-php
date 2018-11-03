<?php 

namespace Core;

class Helper {

    /**
    * convert the string with hyphens to camelCase
    * e.g. post-authors => postAuthors
    * 
    * @param string $string to convert
    * 
    * @return void
    */

    public static function convertToCamelCase($string){
        return lcfirst(self::convertToStudlyCaps($string));
    }

    /** 
       * Convert the string with hyphens to StudyCaps,
       * e.g. post-authors => PostAuthors
       * 
       * @param string the string to convert
       */
      public static function convertToStudlyCaps($string){
        return str_replace(' ','', ucwords(str_replace('-',' ', $string)));
    }

    public static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}