<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        // An expired session on a form submit should send the user to sign in again, not show a 419 page.
        $this->renderable(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            return redirect()->guest('/login')->withErrors(['email' => 'Your session expired. Please sign in again.']);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
