<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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


    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        // Check if the request is an API call (expects JSON)
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'Login first',
        'status' => 401], 401);
        }
    
        // Redirect to the login page for web requests
        return redirect()->guest(route('login'));
    }
    


    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
