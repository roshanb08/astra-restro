<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * You can put '*' to trust all proxies (common behind Nginx/Cloudflare/ALB),
     * or list specific IPs/CIDRs for stricter setups.
     *
     * Example strict: ['172.17.0.0/16', '10.0.0.0/8']
     */
    protected $proxies = '*';

    /**
     * Headers used to detect proxies and https scheme.
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO;
}
