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
        // এখানে আপনার URI গুলো যোগ করুন
        'api/*',           // সমস্ত API রুট CSRF থেকে মুক্ত
        'contacts/*',      // সব কন্ট্যাক্ট রুট মুক্ত
        'webhook/*',       // কোনও বিশেষ রুট যেমন Webhook
    ];
}

