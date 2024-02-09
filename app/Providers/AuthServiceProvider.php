<?php

namespace App\Providers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Extract;
use App\Policies\BudgetPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ExtractPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Budget::class => BudgetPolicy::class,
        Category::class => CategoryPolicy::class,
        Extract::class => ExtractPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
