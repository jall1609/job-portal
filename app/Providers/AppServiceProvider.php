<?php

namespace App\Providers;

use App\Models\JobVacancy;
use App\Models\User;
use Carbon\Carbon;
use Exception;
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
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');

        Gate::define('job_vacancy_owner', function (User $users, JobVacancy $job) {
            if ($job->company_id != $users->company->id) return false;
            return true;
        });
    }
}
