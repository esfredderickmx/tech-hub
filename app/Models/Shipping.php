<?php

namespace App\Models;

use App\Enums\ShippingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model {
  protected $fillable = [
    'address',
    'dispatch_date',
    'delivery_date',
    'cost',
    'status',
  ];

  protected function casts(): array {
    return [
      'dispatch_date' => 'datetime',
      'delivery_date' => 'datetime',
      'status' => ShippingStatus::class,
    ];
  }

  public function purchase(): BelongsTo {
    return $this->belongsTo(Purchase::class);
  }

  public function employee(): BelongsTo {
    return $this->belongsTo(Employee::class);
  }
}
