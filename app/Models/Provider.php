<?php

namespace App\Models;

use App\Enums\ProviderType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model {
  protected $fillable = [
    'name',
    'address',
    'email',
    'phone_number',
    'type',
  ];

  protected function casts(): array {
    return [
      'type' => ProviderType::class,
    ];
  }

  public function products(): HasMany {
    return $this->hasMany(Product::class);
  }
}
