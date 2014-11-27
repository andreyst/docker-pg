<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$env = $app->detectEnvironment(function() {
  if (isset($_SERVER['HTTP_X_REAL_IP']) &&
      substr($_SERVER['HTTP_X_REAL_IP'], 0, 7) === "192.168") {
    return 'local';
  }

  return 'production';
});

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load this Illuminate application. We will keep this in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

$framework = $app['path.base'].
                 '/vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

/*
|--------------------------------------------------------------------------
| Define Trace singleton
|--------------------------------------------------------------------------
|
| Here we define Trace singleton, which we use in logger handler to
| append traceId and spanId to every log item.
|
*/

$app->singleton('Trace', function() {
  // <REFACTORME>
  // Move this class definition somewhere appropriate
  class Trace {
    public $traceId = "-";
    public $spanId = "-";
    public function generateNewTrace($return = false) {
      // <REFACTORME>
      // Choose more efficient random string generation method
      $traceId = md5(mt_rand());
      $spanId = substr(md5(mt_rand()), 0, 8);
      // </REFACTORME>
      if ($return) {
        $trace = [
          'traceId' => $traceId,
          'spanId' => $spanId
        ];
        return $trace;
      }
      $this->traceId = md5(mt_rand());
      $this->spanId = substr(md5(mt_rand()), 0, 8);
    }

    public function populateTrace($traceId, $spanId) {
      $this->traceId = $traceId;
      $this->spanId = $spanId . '.' . substr(md5(mt_rand()), 0, 8);
    }
  }
  // </REFACTORME>

  $trace = new Trace;
  return $trace;
});

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
