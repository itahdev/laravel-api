<?php

namespace App\Exceptions;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiException extends RuntimeException
{
    /** @var mixed */
    private mixed $data;

    /**
     * ApiException constructor.
     *
     * @param int            $httpCode
     * @param string         $message
     * @param mixed|null     $data
     * @param Throwable|null $previous
     */
    public function __construct(int $httpCode, string $message, mixed $data = null, Throwable $previous = null)
    {
        $this->data = $data;

        parent::__construct($message, $httpCode, $previous);
    }

    /**
     * @return mixed|null
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param int        $httpCode
     * @param mixed|null $data
     * @return ApiException
     */
    public static function response(int $httpCode, mixed $data = null): ApiException
    {
        $message = data_get(Response::$statusTexts, $httpCode);

        return new ApiException($httpCode, $message, $data);
    }

    /**
     * @param string     $message
     * @param mixed|null $data
     * @return ApiException
     */
    public static function serviceUnavailable(string $message = 'Service Unavailable', mixed $data = null): ApiException
    {
        return new ApiException(Response::HTTP_SERVICE_UNAVAILABLE, $message, $data);
    }

    /**
     * @param string     $message
     * @param mixed|null $data
     * @return ApiException
     */
    public static function badRequest(string $message = 'Bad Request', mixed $data = null): ApiException
    {
        return new ApiException(Response::HTTP_BAD_REQUEST, $message, $data);
    }

    /**
     * @param string     $message
     * @param mixed|null $data
     * @return ApiException
     */
    public static function forbidden(string $message = 'Forbidden', mixed $data = null): ApiException
    {
        return new ApiException(Response::HTTP_FORBIDDEN, $message, $data);
    }

    /**
     * @param string     $message
     * @param mixed|null $data
     * @return ApiException
     */
    public static function notFound(string $message = 'Not Found', mixed $data = null): ApiException
    {
        return new ApiException(Response::HTTP_NOT_FOUND, $message, $data);
    }

    /**
     * @param string     $message
     * @param mixed|null $data
     * @return ApiException
     */
    public static function conflict(string $message = 'Conflict', mixed $data = null): ApiException
    {
        return new ApiException(Response::HTTP_CONFLICT, $message, $data);
    }
}
