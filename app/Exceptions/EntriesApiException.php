<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class EntriesApiException extends Exception
{
    public function __construct(
        string $message = "Error en Entries API", 
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR, 
        Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
