<?php
/**
 * Base controller to do base stuff...
 */
namespace ConsoleLogger\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Network\Response;
use Cake\I18n\Time;
use Cake\I18n\Date;

use ConsoleLogger\Log\Logger;

/**
 */
class BaseController extends Controller
{
      public function initialize()
      {
          parent::initialize();
      }

      public function beforeFilter(Event $event){
        parent::beforeFilter($event);

        $data = [
          'controller' => $this->request->params['controller'],
          'action' => $this->request->params['action'],
          'data' => $this->request->is('get') ? $this->request->query : $this->request->data,
          'url' => $this->request->url,
          'matchedRoute' => $this->request->params['_matchedRoute'],
        ];

        $data = "[" . $data['controller'] . "::" . $data['action'] . "] " . (!empty($data['data']) ? "- " . json_encode($data['data']) : '') . " - Route: " . $data['matchedRoute'];

        Logger::log($data);
      }

      //////////////////////////////////////
      // Message, can be a string or an array or object..
      // Level is used as styles, styles can be custom such as annoy that is defined below and pre-defined that are
      // set in ConsoleOutput class
      /////////////////////////////////////
      protected function puts($message, $level = 'info')
      {
        if($level == null){
          $level = 'annoy';
        }
        Logger::log($level, $message, []);
      }
}
