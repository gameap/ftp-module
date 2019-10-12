<?php

namespace GameapModules\Ftp\Exceptions;

use Throwable;

class ExecuteCommandException extends FtpModuleException
{
    public function __construct($message = "Command execution error", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}