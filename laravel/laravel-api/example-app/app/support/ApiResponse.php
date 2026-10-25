<?php


namespace App\Support;


use Illuminate\Http\JsonResponse;


class ApiResponse
{
   public static function success(string $message, mixed $data, int $status = 200): JsonResponse
   {
       return response()->json([
           'status' => 'success',
           'message' => $message,
           'data' => $data,
       ], $status);
   }


   public static function error(string $message, int $status): JsonResponse
   {
       return response()->json(['error' => $message], $status);
   }
}
