<?php

namespace App\Providers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pour les équipes
        Gate::define('update-equipe', function ($user, Equipe $equipe) {
            return $user->role?->name === 'admin' || $user->id === $equipe->user_id;
        });
        // Pour les joueurs
        Gate::define('update-joueur', function ($user, Joueur $joueur) {
            return $user->role?->name === 'admin' || $user->id === $joueur->user_id;
        });

        Gate::define("isUser", function ($user) {
            return $user?->role->name == 'user';
        });

        Gate::define("isCoach", function ($user) {
            return $user?->role->name == 'coach';
        });

        Gate::define("isAdmin", function ($user) {
            return $user?->role->name == 'admin';
        });
    }

}
