<?php

namespace App\Traits;

trait WithErrorHandling
{
    /**
     * Perform the given callback with exception handling.
     *
     * @param \Closure $callback
     * @return mixed
     */
    protected function withErrorHandling($callback)
    {
        try {
            return $callback();
        } catch (\Exception $exception) {
            return response()->error(
                code: $exception->getCode(),
                message: $exception->getMessage(),
                data: [],
                status: 500
            );
        }
    }
}
