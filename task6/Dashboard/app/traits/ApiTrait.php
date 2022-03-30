<?php

namespace App\traits;

trait ApiTrait
{
    public static function successMessage(string $message = "success", int $statuscode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => (object)[],
            'errors' => (object)[],
        ], $statuscode);
    }


    public static function errorMessage(array $errors, string $message = "error", int $statuscode = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => (object)[],
            'errors' => (object)$errors,
        ], $statuscode);
    }


    public static function data(array $data, string $message = "", int $statuscode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => (object)$data,
            'errors' => (object)[],
        ], $statuscode);
    }
}
