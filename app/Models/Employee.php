<?php

namespace App\Models;

use App\Enums\EmployeePosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model {
  protected $fillable = [
    'first_name',
    'last_name',
    'phone_number',
    'position',
  ];

  protected function casts(): array {
    return [
      'position' => EmployeePosition::class,
    ];
  }

  public function products(): BelongsToMany {
    return $this->belongsToMany(Product::class, 'inventory_entry')->as('inventory_entries')->withPivot(['quantity', 'type'])->withTimestamps();
  }

  public function user(): HasOne {
    return $this->hasOne(User::class);
  }

  public function purchases(): HasMany {
    return $this->hasMany(Purchase::class);
  }

  public function shippings(): HasMany {
    return $this->hasMany(Shipping::class);
  }
}
