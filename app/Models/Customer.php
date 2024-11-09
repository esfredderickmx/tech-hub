<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model {
  protected $fillable = [
    'first_name',
    'last_name',
    'phone_number',
  ];

  public function user(): HasOne {
    return $this->hasOne(User::class);
  }

  public function purchases(): HasMany {
    return $this->hasMany(Purchase::class);
  }
}
