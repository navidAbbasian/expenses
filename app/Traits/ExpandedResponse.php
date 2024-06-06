<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait ExpandedResponse
{
    public function JSONResponse($response, $status, $message = null): JsonResponse
    {
        return response()
            ->json([
                'message' => $message,
                'status' => $status,
                'data' => $response,
            ], $status);
    }

    /**
     * @throws Exception
     */
    public function messageResponse($status, $message, $response = null): JsonResponse
    {
        if (!$message) {
            throw new Exception('The message is required.');
        }

        return $this->JSONResponse(response: $response, status: $status, message: $message);
    }

    protected function ok($resource): JsonResponse
    {
        return $this->JSONResponse(response: $resource, status: 200);
    }

    protected function created($resource): JsonResponse
    {
        return $this->JSONResponse($resource, 201);
    }

    protected function noContent(): JsonResponse
    {
        return $this->JSONResponse(null, 204);
    }

    /**
     * @throws Exception
     */
    protected function resourceNotFound(): JsonResponse
    {
        return $this->messageResponse(status: 404, message: 'Error: Resource not found');
    }
}
