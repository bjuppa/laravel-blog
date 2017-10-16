<?php

namespace Bjuppa\LaravelBlog\Tests\Feature\Fakes;

use Closure;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('X-Test-Middleware', 'OK');

        return $response;
    }
}
