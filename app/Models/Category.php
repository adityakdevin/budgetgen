<?php

namespace App\Models;

use App\Enums\CategoryType;
use App\Models\Scopes\AlphabeticalOrderScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy(AlphabeticalOrderScope::class)]
class Category extends Model
{
    protected $fillable = ['name', 'type', 'parent_id'];

    protected $casts = [
        'type' => CategoryType::class,
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children(): HasMany|Category
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function transactions(): HasMany|Category
    {
        return $this->hasMany(Transaction::class);
    }
}
