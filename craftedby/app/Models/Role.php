<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use HasUuids;
    public $incrementing = false; /* because UUID (Universally Unique Identifier)*/
    protected $fillable = ['name'];

    public function users()
    {
        // Define the many-to-many relationship with the User model
        return $this->belongsToMany(User::class);
    }
}
