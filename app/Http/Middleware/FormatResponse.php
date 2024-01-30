<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FormatResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $existGetData = method_exists($response, 'getData');

        if($response->isSuccessful() && $existGetData){
            if(! isset($response->getData()->current_page)){
                return response()->json([
                    'error' => false,
                    'data' => $response->getData()
                ]);
            }
            return response()->json(array_merge(
                ['error' => false, 'paginate' => true],
                (array) $response->getData()
            ));
        }

        return $response;
    }
}
