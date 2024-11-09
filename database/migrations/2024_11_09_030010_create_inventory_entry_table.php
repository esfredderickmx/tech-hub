<?php

use App\Enums\InventoryEntryType;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('inventory_entry', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreignIdFor(Employee::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
      $table->integer('quantity');
      $table->enum('type', InventoryEntryType::valuesToArray())->default(InventoryEntryType::ACQUISITION);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('inventory_entry');
  }
};
