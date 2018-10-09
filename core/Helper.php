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

    public function convertToCamelCase($string){
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /** 
       * Convert the string with hyphens to StudyCaps,
       * e.g. post-authors => PostAuthors
       * 
       * @param string the string to convert
       */
      public function convertToStudlyCaps($string){
        return str_replace(' ','', ucwords(str_replace('-',' ', $string)));
    }

}