<?php
namespace ConsoleLogger\Log;

use Cake\Log\Engine\ConsoleLog;
use Cake\Console\ConsoleOutput;
use Cake\Utility\Text;

class Logger
{
    //////////////////////////////////////
    // Message, can be a string or an array or object..
    // Level is used as styles, styles can be custom such as annoy that is defined below and pre-defined that are
    // set in ConsoleOutput class
    /////////////////////////////////////
    public static function log($message, $level = 'info'){
      if($level == null){
        $level = 'annoy';
      }
      Self::GetLogger()->log($level, $message, []);
    }

    private static function GetLogger(){
      $output = new ConsoleOutput();

      $output->styles('annoy', ['text' => 'yellow', 'blink' => true]);
      $output->styles('http_response', ['text' => 'yellow']);
      $output->styles('http_request', ['text' => 'cyan']);

      $output->outputAs(ConsoleOutput::COLOR);

      $logger = new ConsoleLog(['stream' => $output]);
      return $logger;
    }
}
