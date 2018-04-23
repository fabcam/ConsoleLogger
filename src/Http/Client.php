<?php

namespace ConsoleLogger\Http;

use ConsoleLogger\Log\Logger;
use Cake\Http\Client\Request;

/**
* Http client wrapper class that logs to console every http method
**/
class Client extends \Cake\Http\Client
{
  public function get($url, $data = [], array $options = [])
  {
      if(is_string($data)){
        $data = ['q' => $data];
      }
      return $this->doRequest(Request::METHOD_GET, $url, $data, $options);
  }

  public function post($url, $data = [], array $options = [])
  {
      return $this->doRequest(Request::METHOD_POST, $url, $data, $options);
  }

  public function put($url, $data = [], array $options = [])
  {
      return $this->doRequest(Request::METHOD_PUT, $url, $data, $options);
  }

  public function patch($url, $data = [], array $options = [])
  {
    return $this->doRequest(Request::METHOD_PATCH, $url, $data, $options);
  }

  public function options($url, $data = [], array $options = [])
  {
    return $this->doRequest(Request::METHOD_OPTIONS, $url, $data, $options);
  }

  public function trace($url, $data = [], array $options = [])
  {
      return $this->doRequest(Request::METHOD_TRACE, $url, $data, $options);
  }

  public function delete($url, $data = [], array $options = [])
  {
      return $this->doRequest(Request::METHOD_DELETE, $url, $data, $options);
  }

  public function head($url, array $data = [], array $options = [])
  {
      return $this->doRequest(Request::METHOD_HEAD, $url, '', $options);
  }

  private function doRequest($method, $url, array $data = [], array $options = [])
  {
    $this->logRequest($method, $url, $data, $options);

    switch ($method) {
      case Request::METHOD_GET:
        $response = parent::get($url, $data, $options);
        break;
      case Request::METHOD_POST:
        $response = parent::post($url, $data, $options);
        break;
      case Request::METHOD_PUT:
        $response = parent::put($url, $data, $options);
        break;
      case Request::METHOD_PATCH:
        $response = parent::patch($url, $data, $options);
        break;
      case Request::METHOD_DELETE:
        $response = parent::delete($url, $data, $options);
        break;
      case Request::METHOD_OPTIONS:
        $response = parent::options($url, $data, $options);
        break;
      case Request::METHOD_TRACE:
        $response = parent::trace($url, $data, $options);
        break;
      case Request::METHOD_HEAD:
        $response = parent::head($url, $data, $options);
        break;
      default:
        $response = "Unkown HTTP Method " . $method;
        break;
    }

    $this->logResponse($response);
    return $response;
  }

  private function logRequest($method, $url, $data, $options){
    $log_info = "HTTP " . $method . " :: [" . $url . "] " . (!empty($data) ? " - DATA :: " . json_encode($data) : '') . (!empty($options) ? " - OPTIONS :: " . json_encode($options) : '');
    Logger::log($log_info, 'http_request');
  }

  private function logResponse($response){
    $log_info = "[RESPONSE STATUS::" . $response->code . "] :: HEADERS :: " . json_encode($response->headers);
    Logger::log($log_info, 'http_response');
  }
}
