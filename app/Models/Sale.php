<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function recordPurchase(int $userId, int $productId, int $quantity): self
    {
        return $this->create([
            'user_id'    => $userId,
            'product_id' => $productId,
            'quantity'   => $quantity,
        ]);
    }
}
