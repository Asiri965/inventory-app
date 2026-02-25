<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = ['name', 'unit', 'quantity'];

    protected $casts = [
        'quantity' => 'decimal:3',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class)->orderBy('created_at', 'desc');
    }
}
