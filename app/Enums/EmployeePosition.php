<?php

namespace App\Enums;

use function array_column;
use function array_map;

enum EmployeePosition: int {
  case ADMIN = 1;
  case SALESMAN = 2;
  case STOCK_MANAGER = 3;
  case SHIPPER = 4;

  public static function valuesToArray(): array {
    return array_column(self::cases(), 'value');
  }

  public static function getOptionsFormat(): array {
    return array_map(function ($case) {
      return ['id' => $case->value, 'name' => $case->getLabel()];
    }, self::cases());
  }

  public function getLabel(): string {
    return match ($this) {
      self::ADMIN => 'Administrativo',
      self::SALESMAN => 'Vendedor',
      self::STOCK_MANAGER => 'Almacén',
      self::SHIPPER => 'Repartidor',
    };
  }

  public function getColor(): string {
    return match ($this) {
      self::ADMIN => 'badge-primary',
      self::SALESMAN => 'badge-success',
      self::STOCK_MANAGER => 'badge-accent',
      self::SHIPPER => 'badge-info',
    };
  }
}
