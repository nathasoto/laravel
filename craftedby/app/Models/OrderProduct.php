<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false; /* because UUID (Universally Unique Identifier)*/

    protected $fillable = [
        'quantity', 'unit_price', 'color', 'size', 'products_id', 'orders_id',
    ];

    public function order(): BelongsTo
    {
        // Define a belongs-to relationship between the OrderProduct model and the Order model
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        // Define a belongs-to relationship between the OrderProduct model and the Product model
        return $this->belongsTo(Product::class);
    }
}
