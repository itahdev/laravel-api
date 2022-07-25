<?php

namespace App\Exceptions;

use App\Transformers\ErrorResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return $this->makeErrorResponse(401, trans('auth.unauthenticated'));
        });

        $this->renderable(function (ApiException $e, $request) {
            return $this->makeErrorResponse($e->getCode(), $e->getMessage(), null, $e->getData());
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            return $this->makeErrorResponse(403, trans('exceptions.assess_denied_permission'));
        });
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param Request             $request
     * @param ValidationException $e
     * @return Response
     */
    protected function invalidJson($request, ValidationException $e): Response
    {
        return $this->makeErrorResponse(
            $e->status,
            trans('validation.general'),
            $e->errors()
        );
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param Request   $request
     * @param Throwable $e
     * @return Response
     */
    protected function prepareJsonResponse($request, Throwable $e): Response
    {
        if (config('app.debug')) {
            return $this->makeErrorResponse(
                500,
                trans('exceptions.server_error'),
                $this->convertExceptionToArray($e)
            );
        }

        return $this->makeErrorResponse(500, trans('exceptions.server_error'));
    }

    /**
     * @param int        $code
     * @param string     $message
     * @param array|null $errors
     * @param mixed|null $data
     * @return Response
     */
    protected function makeErrorResponse(int $code, string $message, ?array $errors = null, mixed $data = null): Response
    {
        return (new ErrorResource($code, $message, $errors, $data))
            ->response()
            ->setStatusCode($code);
    }
}
