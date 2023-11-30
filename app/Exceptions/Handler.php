<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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

        $this->renderable(function (RouteNotFoundException $e, $request) {
            if ($request->wantsjson()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'generic' => 'Not Authenticated'
                    ]
                ], JsonResponse::HTTP_FORBIDDEN);
            }
        });

        // $this->renderable(function (Throwable $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'errors' => [
        //             // 'generic'=>sprintf('Error: %s',$e->getMessage()) if u want to show detailed error
        //             'generic' => "unkown error"
        //         ]
        //     ], JsonResponse::HTTP_BAD_REQUEST);
        // });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
