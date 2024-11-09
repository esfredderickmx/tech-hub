<?php

namespace App\Enums;

use function array_column;

enum InventoryEntryType: int {
  case ACQUISITION = 1;
  case REFUND = 2;
  case ADJUSTMENT = 3;

  public static function valuesToArray(): array {
    return array_column(self::cases(), 'value');
  }
}
