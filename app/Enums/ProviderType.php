<?php

namespace App\Enums;

use function array_column;
use function array_map;

enum ProviderType: int {
  case NATURAL = 1;
  case JURIDICAL = 2;

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
      self::NATURAL => 'Física',
      self::JURIDICAL => 'Moral',
    };
  }

  public function getColor(): string {
    return match ($this) {
      self::NATURAL => 'badge-primary',
      self::JURIDICAL => 'badge-accent',
    };
  }
}
