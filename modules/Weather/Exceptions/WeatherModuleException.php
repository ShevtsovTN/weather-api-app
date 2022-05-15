<?php

namespace Modules\Weather\Exceptions;

use Exception;

class WeatherModuleException extends Exception
{
    public function __construct($message = 'Some failure', $code = 500)
    {
        parent::__construct($message, $code);
    }
}
