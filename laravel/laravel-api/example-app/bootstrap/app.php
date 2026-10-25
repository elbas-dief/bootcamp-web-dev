<?php


use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
   ->withRouting(
       web: __DIR__.'/../routes/web.php',
       // 1. Pintu Masuk pertama
       api: __DIR__.'/../routes/api.php',
       apiPrefix: '',
       commands: __DIR__.'/../routes/console.php',
       health: '/up',
   )
   ->withMiddleware(function (Middleware $middleware): void {
       $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);


       $middleware->web(append: [
           HandleAppearance::class,
           HandleInertiaRequests::class,
           AddLinkHeadersForPreloadedAssets::class,
       ]);
   })
   ->withExceptions(function (Exceptions $exceptions): void {
       $exceptions->shouldRenderJsonWhen(
           fn (Request $request) => $request->is('books*') || $request->is('health') || $request->expectsJson(),
       );


       $exceptions->render(function (\Illuminate\Validation\ValidationException $exception, Request $request) {
           if ($request->is('books*')) {
               return response()->json([
                   'error' => $exception->validator->errors()->first(),
               ], 422);
           }
       });


       $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception, Request $request) {
           if ($request->is('books*')) {
               $message = $exception->getPrevious() instanceof \Illuminate\Database\Eloquent\ModelNotFoundException
                   ? 'buku tidak ditemukan'
                   : 'endpoint tidak ditemukan';


               return response()->json(['error' => $message], 404);
           }
       });


       $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $exception, Request $request) {
           if ($request->is('books*')) {
               return response()->json(['error' => 'method tidak diizinkan'], 405);
           }
       });


       $exceptions->render(function (\Throwable $exception, Request $request) {
           if ($request->is('books*')) {
               return response()->json(['error' => 'terjadi kesalahan pada server'], 500);
           }
       });
   })->create();
