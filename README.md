#Console Logger plugin for CakePHP

Logs whatever you want to console.

Usage:

Import Logger
```
use ConsoleLogger\Log\Logger;
```
And then:
```
Logger::log('message', 'info');
```
log function can receive as a message an array, object or string.
Second parameter is level, used mostly for styling.

There are some pre defined levels:
```
$output->styles('annoy', ['text' => 'yellow', 'blink' => true]);
$output->styles('http_response', ['text' => 'yellow']);
$output->styles('http_request', ['text' => 'cyan']);
```

And some defined in Cake's class ConsoleOutput:
```
protected static $_styles = [
    'emergency' => ['text' => 'red'],
    'alert' => ['text' => 'red'],
    'critical' => ['text' => 'red'],
    'error' => ['text' => 'red'],
    'warning' => ['text' => 'yellow'],
    'info' => ['text' => 'cyan'],
    'debug' => ['text' => 'yellow'],
    'success' => ['text' => 'green'],
    'comment' => ['text' => 'blue'],
    'question' => ['text' => 'magenta'],
    'notice' => ['text' => 'cyan']
];
```

There is one base controller that could be used to log every action.
In your AppController:

```
...

use ConsoleLogger\Controller\BaseController;

class AppController extends BaseController
{
  ...
```

There is also a wrapper for Http Client class that logs every http method requests and responses
Instead of using Cake's Http Client do:

```
use ConsoleLogger\Http\Client;
```

A behavior is also included in oder to log every query that is executed in the BeforeFind callback.
In order to use it just add the following line to the desired Table:

```
$this->addBehavior('ConsoleLogger.Log')
```

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require fabcam/console-logger
```
