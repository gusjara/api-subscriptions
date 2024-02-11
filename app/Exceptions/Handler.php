<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // majeo de error cuando no hay 
    public function render($request, Exception|Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => "Error. The requested resource does not exist."
            ], 404);
        }

        return parent::render($request, $e);
    }
}
