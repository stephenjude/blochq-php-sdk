<?php

namespace Stephenjude\BlocHqPhpSdk\Exceptions;

use Exception;

class ForbiddenRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct('Not enough permission to perform this operation.');
    }
}
