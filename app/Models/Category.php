<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CategoryType;
use App\Models\Scopes\AlphabeticalOrderScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy(AlphabeticalOrderScope::class)]
final class Category extends Model
{
    protected $fillable = ['name', 'type', 'parent_id'];

    protected $casts = [
        'type' => CategoryType::class,
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children(): HasMany|self
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function transactions(): HasMany|self
    {
        return $this->hasMany(Transaction::class);
    }
}
