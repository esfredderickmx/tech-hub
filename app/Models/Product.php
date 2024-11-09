<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
  protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'image',
  ];

  public function provider(): BelongsTo {
    return $this->belongsTo(Provider::class);
  }

  public function purchases(): BelongsToMany {
    return $this->belongsToMany(Purchase::class, 'purchase_detail')->as('purchase_details')->withPivot(['quantity', 'unit_price'])->withTimestamps();
  }

  public function employees(): BelongsToMany {
    return $this->belongsToMany(Employee::class, 'inventory_entry')->as('inventory_entry')->withPivot(['quantity', 'type'])->withTimestamps();
  }
}
