<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

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
        RedirectIfAuthenticated::redirectUsing(function () {
            $role = auth()->user()->role;
            if ($role == UserRoleEnum::ADMIN->value) {
                return route('admin.dashboard');
            }
            elseif ($role == UserRoleEnum::MODERATOR->value) {
                return route('moderator.dashboard');
            }
            else {
                return route('customer.dashboard');
            }

        });

        Builder::macro('filterByStatus', function ($status) {
            if ($status) {
                return $this->where('status', $status);
            }
            return $this;
        });

        Builder::macro('filterBy', function ($column,$value) {
            if ($value) {
                return $this->where($column, $value);
            }
            return $this;
        });

        Builder::macro('search', function ($field, $data) {
            return $data ? $this->where($field, 'like', "%$data%") : $this;
        });

        Builder::macro('searchFullname', function ($data) {
            return $data ? $this->where(DB::raw("CONCAT(first_name, ' ', COALESCE(last_name, ''), ' ', COALESCE(middle_name, ''))"), 'LIKE', "%$data%") : $this;
        });

        Builder::macro('orSearch', function ($field, $data) {
            return $data ? $this->orWhere($field, 'like', "%$data%") : $this;
        });

        Builder::macro('orSearchFullname', function ($data) {
            return $data ? $this->orWhere(DB::raw("CONCAT(first_name, ' ', COALESCE(last_name, ''), ' ', COALESCE(middle_name, ''))"), 'LIKE', "%$data%") : $this;
        });

        Builder::macro('filterByDate', function ($dateFrom, $dateTo, $column='created_at') {
            if ($dateFrom && $dateTo) {
                return $this->whereBetween($column, [
                    Carbon::parse($dateFrom)->startOfDay(),
                    Carbon::parse($dateTo)->endOfDay()
                ]);
            }
            return $this;
        });

        Paginator::useBootstrapFive();
    }
}
