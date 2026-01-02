<?php

    namespace App\Traits;

    use Illuminate\Http\JsonResponse;

    trait ApiResponse
    {
        protected function success(
            string $message = 'OK',
            mixed $data = null,
            int $status = 200,
            array $meta = []
        ): JsonResponse {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $data,
                'meta'    => $meta
            ], $status);
        }

        protected function error(
            string $message = 'Error',
            int $status = 400,
            array $errors = [],
            array $meta = []
        ): JsonResponse {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
                'meta'    => $meta
            ], $status);
        }
    }

