<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @return HasMany
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes():BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    public function scopeWithFilters($query, $sizes)
    {
        return $query->when(count($sizes), function ($query) use ($sizes) {
            $query->whereIn('name', $sizes);
        });


    }
}
