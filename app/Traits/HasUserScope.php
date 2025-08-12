<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasUserScope
{
    public static function bootHasUserScope(): void
    {
        static::creating(function ($model): void {
            if (Auth::check() && empty($model->user_id)) {
                $model->user_id = Auth::id();
            }
        });

        static::addGlobalScope('user_scope', function (Builder $builder): void {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });
    }
}
