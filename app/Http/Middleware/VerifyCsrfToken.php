<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/payemnt_status',
        '/payment_callback',
        '/ro/transactions-details',
        '/ds/ro_transactions_details',
        '/admin/transactions-details',
        '/verification.verify',
        '/forgot-password'
    ];
}
