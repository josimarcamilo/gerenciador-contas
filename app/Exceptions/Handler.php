<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            $errors = [];
            foreach ($e->errors() as $err) {
                $errors[] = $err[0];
            }

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'errors' => $errors,
                'data' => [],
            ], $e->status);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'data' => [],
            ], 404);
        }

        if ($e instanceof QueryException) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'data' => [],
            ], 500);
        }

        $code = $e->getCode();

        if (method_exists($e, 'getStatusCode')) {
            $code = $e->getStatusCode();
        }

        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'data' => [],
        ], $code);

        return parent::render($request, $e);
    }
}
