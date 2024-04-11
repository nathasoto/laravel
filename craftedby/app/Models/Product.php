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
        'name', 'price', 'weight', 'stock', 'material', 'history', 'image_path', 'description', 'categories_id', 'shop_id',
    ];


    public function categories(): BelongsTo
    {
        // Define a belongs-to relationship between the Product model and the Category model
        return $this->belongsTo(Category::class);
    }
    public function colors(): BelongsToMany
    {
        // Define a many-to-many relationship between the Product model and the Color model
        return $this->belongsToMany(Color::class);
    }

    public function sizes(): BelongsToMany
    {
        // Define a many-to-many relationship between the Product model and the Size model
        return $this->belongsToMany(Size::class);
    }
    public function user(): BelongsTo
    {
        // Define a belongs-to relationship between the Product model and the User model
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo
    {
        // Define a belongs-to relationship between the Product model and the Shop model
        return $this->belongsTo(Shop::class);
    }
    public function orderDetail(): HasMany
    {
        // Define a one-to-many relationship between the Product model and the OrderProduct model
        return $this->hasMany(OrderProduct::class);
    }
}
