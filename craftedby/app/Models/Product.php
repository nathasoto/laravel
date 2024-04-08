<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false; /* because UUID (Universally Unique Identifier)*/

    protected $fillable = [
        'name', 'price', 'weight', 'stock', 'material', 'history_anécdota', 'image_path', 'description', 'categories_id', 'shop_id',
    ];


    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function color(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    public function size(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
