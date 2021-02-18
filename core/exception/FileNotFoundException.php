<?php
namespace app\core\exception;

class FileNotFoundException extends \Exception{
       protected $code = 404;
       protected $message = 'File not found'; 
}