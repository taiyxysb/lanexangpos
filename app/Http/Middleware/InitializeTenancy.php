<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancy
{
    public function handle(Request $request, Closure $next): Response
    {
        $host      = $request->getHost();
        $parts     = explode('.', $host);
        $subdomain = $parts[0];

        // ຖ້າ local dev ໃຊ້ ?tenant=xxx ແທນ subdomain
        if ($request->has('tenant')) {
            $subdomain = $request->get('tenant');
        }

        $tenant = Tenant::where('subdomain', $subdomain)
                        ->whereIn('status', ['trialing', 'active'])
                        ->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // inject tenant ໃສ່ທົ່ວ app
        app()->instance('tenant', $tenant);
        config(['app.tenant_id' => $tenant->id]);

        return $next($request);
    }
}