<?php

namespace App\Exceptions;

use Exception;

class TaskNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json(['error' => 'Task not found.'], 404);
    }
}
