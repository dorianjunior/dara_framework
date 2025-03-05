<?php

namespace App\Core;

class Middleware
{
    /**
     * Recebe um callback onde as rotas do grupo são definidas.
     *
     * @param callable $callback
     * @return void
     */
    public function group(callable $callback): void
    {
        $callback();
        Route::resetGroupMiddleware();
    }
}
