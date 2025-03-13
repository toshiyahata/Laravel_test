<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // User
        $this->app->bind(\App\MyDefined\Repository\User\UserRepoInterface::class, \App\MyDefined\Repository\User\UserRepository::class);

        // Client
        $this->app->bind(\App\MyDefined\Repository\Master\ClientRepoInterface::class, \App\MyDefined\Repository\Master\ClientRepository::class);

        // Department
        $this->app->bind(\App\MyDefined\Repository\Organization\DepartmentRepoInterface::class, \App\MyDefined\Repository\Organization\DepartmentRepository::class);

        // OrderCategory
        $this->app->bind(\App\MyDefined\Repository\Master\OrderCategoryRepoInterface::class, \App\MyDefined\Repository\Master\OrderCategoryRepository::class);

        // Campaign
        $this->app->bind(\App\MyDefined\Repository\Campaign\CampaignRepoInterface::class, \App\MyDefined\Repository\Campaign\CampaignRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
