<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleVerif
{
    public static function isAdmin($user)
    {
        return $user?->role?->name === 'admin';
    }

    public static function isCoach($user)
    {
        return $user?->role?->name === 'coach';
    }

    public static function isUser($user)
    {
        return $user?->role?->name === 'user';
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // vérifie si le user est connécté
        if (!$user) {
            return redirect()->route('login');
        }

        // vérifie si le role du user connecté est le meme que les roles donné dans la fonction
        foreach ($roles as $role) {
            if (
                ($role === 'admin' && self::isAdmin($user)) ||
                ($role === 'coach' && self::isCoach($user)) ||
                ($role === 'user' && self::isUser($user))
            ) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
