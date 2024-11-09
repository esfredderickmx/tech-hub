<?php

namespace App\Enums;

use function array_column;

enum PurchaseType: int {
  case ONSITE = 1;
  case ONLINE = 2;

  public static function valuesToArray(): array {
    return array_column(self::cases(), 'value');
  }
}
