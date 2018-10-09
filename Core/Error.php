<?php 

namespace Core;

/**
 * Error and exception handler
 * 
 */

 class Error {
     /**
      * Error handler. Convert all erros to Exceptions by trhowing an ErrorException
      *
      * @param int $level Error level
      * @param string $message error message
      * @param string $file Filename the error was raised in
      * @param int $line Line number in the File
      *
      * @return void
      */
    public static function errorHandler($level, $message, $file, $line){
        if(error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }    

    /**
     * Exception Handler.
     * 
     * @param Excepiton $exception The exception
     * 
     * @return void
     */
    public static function exceptionHandler($exception) {
        
        // code is 404 or 500
        $code = $exception->getCode();
        if($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if(config('SHOW_ERRORS')) {
            echo "<h1> Fatal Error </h1>";
            echo "<p> Uncaught exception: '". get_class($exception) ."'</p>";
            echo "<p> Message: '" . $exception->getMessage() . "'</p>";
            echo "<p> Stack trace: <pre>" . $exception->getTraceAsString() ."</pre></p>";
            echo "<p> Throw in '" .  $exception->getFile() ."' on line " . $exception->getLine() . "</p>";

        } else {
            $log = dir_name(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            init_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();
            
            error_log($message);

            
        }
    }     
}