<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'https://museum-bahari.telenurse.web.id/api',
        'https://museum-bahari.telenurse.web.id/api/tickets/order',
        'https://museum-bahari.telenurse.web.id/api/link/submit',
    ];
}
