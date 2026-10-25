<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItems extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }
}
