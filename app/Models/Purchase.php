<?php

namespace App\Models;

use App\Enums\PurchaseType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model {
  protected $fillable = [
    'total',
    'type',
  ];

  protected function casts(): array {
    return [
      'type' => PurchaseType::class,
    ];
  }

  public function customer(): BelongsTo {
    return $this->belongsTo(Customer::class);
  }

  public function employee(): BelongsTo {
    return $this->belongsTo(Employee::class);
  }

  public function products(): BelongsToMany {
    return $this->belongsToMany(Product::class, 'purchase_detail')->as('purchase_details')->withPivot(['quantity', 'unit_price'])->withTimestamps();
  }

  public function shipping(): HasOne {
    return $this->hasOne(Shipping::class);
  }
}
