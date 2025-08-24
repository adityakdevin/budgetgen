<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CategoryType;
use App\Models\Scopes\AlphabeticalOrderScope;
use App\Traits\HasUserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy(AlphabeticalOrderScope::class)]
final class Category extends Model
{
    use HasUserScope;

    protected $fillable = ['name', 'type', 'parent_id', 'user_id'];

    protected $casts = [
        'type' => CategoryType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
