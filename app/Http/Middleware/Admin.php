<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($req, Closure $next){
        if (session('admin')=="granted"){
            return $next($req);
        }

        return redirect('/admin-login');
    }
}
