<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCart extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false; /* because UUID (Universally Unique Identifier)*/

    protected $fillable = [
        'quantity', 'unit_price', 'color', 'size', 'products_id','user_id', 'status',
    ];
    public function user(): BelongsTo
    {
        // Define a belongs-to relationship between the Address model and the User model
        return $this->belongsTo(User::class);
    }
}
