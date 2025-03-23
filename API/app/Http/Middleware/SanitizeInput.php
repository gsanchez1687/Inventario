<?php

namespace App\Http\Middleware;

use Closure;

class SanitizeInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Obtén los datos del request
        $input = $request->all();

        // Aplica limpieza recursiva a los campos
        $sanitized = $this->sanitize($input);

        // Reemplaza los datos originales con los sanitizados
        $request->merge($sanitized);

        return $next($request);
    }

    /**
     * Limpia los campos de entrada recursivamente.
     *
     * @param  array|string  $input
     * @return array|string
     */
    private function sanitize($input)
    {
        if (is_array($input)) {
            return array_map([$this, 'sanitize'], $input);
        }

        if (is_string($input)) {
            // Remover espacios extra y caracteres especiales
            return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        }

        return $input;
    }
}
