<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false; /* because UUID (Universally Unique Identifier)*/

    protected $fillable = [
        'total', 'shipping address', 'status', 'user_id',
    ];

    public function user(): BelongsTo
    {
        // Define a belongs-to relationship between the Order model and the User model
        return $this->belongsTo(User::class);
    }
    public function orderDetails()
    {
        // Define a one-to-many relationship between the Order model and the OrderProduct model
        return $this->hasMany(OrderProduct::class);
    }
}
