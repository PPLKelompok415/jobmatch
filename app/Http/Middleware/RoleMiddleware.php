<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login/admin');
        }
        
        $user = Auth::user();
        $hasRole = false;
        
        try {
            // Cara 1: Coba hasRole jika tersedia
            if (method_exists($user, 'hasRole') && $user->hasRole($role)) {
                $hasRole = true;
            } 
            // Cara 2: Cek melalui kolom role di tabel users
            else if ($user->role === $role) {
                $hasRole = true;
            }
        } catch (\Exception $e) {
            // Log error jika perlu
            logger()->error('Error checking role: ' . $e->getMessage());
        }
        
        if (!$hasRole) {
            abort(403, 'Unauthorized action.');
        }
        
        return $next($request);
    }
}