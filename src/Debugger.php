<?php

namespace MPWAR;

class Debugger
{
    private $app;
    public function __construct(AppKernel $app)
    {
        $this->app = $app;
        set_exception_handler(array($this, 'exceptionHandler'));
        set_error_handler(array($this, 'errorHandler'));
    }

    public function exceptionHandler($exception)
    {
        echo '<div class="alert alert-danger">';
        echo '<b>Fatal error</b>:  Uncaught exception \''.get_class($exception).'\' with message ';
        echo $exception->getMessage().'<br>';
        echo 'Stack trace:<pre>'.$exception->getTraceAsString().'</pre>';
        echo 'thrown in <b>'.$exception->getFile().'</b> on line <b>'.$exception->getLine().'</b><br>';
        echo '</div>';
        exit();
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        echo '<div class="alert alert-danger">';
        echo '<b>Fatal error</b>:  Uncaught error \''.$errno.'\' with message ';
        echo $errstr.'<br>';
        echo 'error in <b>'.$errfile.'</b> on line <b>'.$errline.'</b><br>';
        echo 'Stack trace:<pre>';
        var_dump(debug_backtrace());
        echo '</pre>';
        echo '</div>';
        exit();
    }

    public function __call($method, $arguments)
    {
        try {
            return call_user_func_array([$this->app, $method], $arguments);
        } catch(\Exception $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
