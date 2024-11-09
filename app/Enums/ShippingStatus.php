<?php

namespace App\Enums;

use function array_column;

enum ShippingStatus: int {
  case PENDING = 1;
  case DISPATCHED = 2;
  case DELIVERED = 3;
  case COMPLETED = 4;
  case CANCELED = 5;

  public static function valuesToArray(): array {
    return array_column(self::cases(), 'value');
  }
}
